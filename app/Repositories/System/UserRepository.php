<?php

namespace App\Repositories\System;

use App\Events\UserCreated;
use App\Exceptions\CustomGenericException;
use App\Exceptions\EncryptedPayloadException;
use App\Exceptions\NotDeletableException;
use App\Exceptions\ResourceNotFoundException;
use App\Exceptions\RoleNotChangeableException;
use App\Interfaces\System\UserRepositoryInterface;
use App\Model\Role;
use App\Repositories\Repository;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository implements UserRepositoryInterface
{
    protected $user;
    protected $role;

    public function __construct(User $user, Role $role)
    {
        parent::__construct($user);
        $this->user = $user;
        $this->role = $role;
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        $query = $this->query();

        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('name', 'LIKE', '%' . $data->keyword . '%');
        }
        if (isset($data->role) && $data->role !== null) {
            $query->where('role_id', $data->role);
        }
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }
        if ($pagination) {
            return $query->orderBy('id', 'DESC')->with('role')->paginate(PAGINATE);
        }

        return $query->orderBy('id', 'DESC')->with('role')->get();
    }
    public function getRoles()
    {
        $mapped = [];
        $roles = $this->role->orderBy('name', 'ASC')->get();
        foreach ($roles as $role) {
            $mapped[$role->id] = $role->name;
        }

        return $mapped;
    }


    public function createUser($request)
    {
        \DB::transaction(function () use ($request) {
            $data = $request->except('_token');
            if ($request->set_password_status == '1') {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }
            $token = $this->generateToken(24);
            $data['token'] = $token;
            $user = $this->model->create($data);
            try {
                event(new UserCreated($user, $token));

                return $user;
            } catch (\Exception $e) {
                \Log::error('User creation failed: ' . $e->getMessage());
                \DB::rollBack();
                return throw new CustomGenericException('User creation failed. Please try again.');
            }
        });
    }

    public function updateUser($id, $request)
    {
        try {
            $data = $request->except('_token');
            $user = $this->itemByIdentifier($id);
            if (isset($request->role_id) && ($user->id == 1 && $request->role_id != 1)) {
                throw new RoleNotChangeableException('The role of the specific user cannot be changed.');
            }
            return $user->update($data);
        } catch (\Exception $e) {
            throw new CustomGenericException($e->getMessage());
        }
    }

    public function deleteUser($id)
    {
        if ($id == 1) {
            throw new NotDeletableException();
        }
        $user = $this->itemByIdentifier($id);
        return $user->delete();
    }
    public function generateToken($length)
    {
        $token = generateToken($length);
        $check = $this->model->where('token', $token)->exists();
        if ($check) {
            $token = generateToken($length);
        }

        return $token;
    }
    public function resetPassword($request)
    {
        $user = $this->itemByIdentifier($request->id);
        return $user->update([
            'password' => Hash::make($request->password),
        ]);
    }
    public function findByEmailAndToken($email, $token)
    {
        try {
            $decryptedToken = decrypt($token);
        } catch (\Exception $e) {
            throw new EncryptedPayloadException('Invalid encrypted data');
        }
        $user = $this->model->where('email', $email)->where('token', $decryptedToken)->first();
        if (!isset($user)) {
            throw new ResourceNotFoundException("User doesn't exist in our system.");
        }

        return $user;
    }
    public function findByEmail($email)
    {
        $user = $this->model->where('email', $email)->first();
        if (!isset($user)) {
            throw new ResourceNotFoundException("User doesn't exist in our system.");
        }
        return $user;
    }
}
