<?php

namespace App\Services;

use App\Events\UserCreated;
use App\Exceptions\EncryptedPayloadException;
use App\Exceptions\InvalidPayloadException;
use App\Exceptions\NotDeletableException;
use App\Exceptions\RoleNotChangeableException;
use App\Mail\system\AccountCreatedEmail;
use App\Mail\system\PasswordSetEmail;
use App\Model\Role;
use App\User;
use ekHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserService extends Service
{
    public function __construct(User $user, Role $role)
    {
        parent::__construct($user);
        $this->role = $role;
    }

    public function getAllData($data, $pagination = true)
    {
        $query = $this->query();
        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('name', 'LIKE', '%' . $data->keyword . '%');
        }
        if (isset($data->role) && $data->role !== null) {
            $query->where('role_id', $data->role);
        }
        if ($pagination) return $query->orderBy('id', 'DESC')->with('role')->paginate(PAGINATE);
        return $query->orderBy('id', 'DESC')->with('role')->get();
    }
    public function getRoles()
    {
        $mapped = [];
        $roles = $this->role->orderBy('name', 'ASC')->get();
        foreach($roles as $key=>$role){
            $mapped[$key]['key'] = $role->id;
            $mapped[$key]['value'] = $role->name;
        }
        return $mapped;
    }

    public function indexPageData($data)
    {
        return [
            'items' => $this->getAllData($data),
            'roles' => $this->getRoles()
        ];
    }

    public function createPageData($data)
    {
        return [
            'roles' => $this->getRoles()
        ];
    }

    public function store($request)
    {
        $data = $request->except('_token');
        if ($request->set_password_status == '1') {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user = $this->model->create($data);
        event(new UserCreated($user));
        return $user;
    }

    public function editPageData($data)
    {
        $user = $this->itemByIdentifier($data);
        return [
            'item' => $user,
            'roles' => $this->getRoles()
        ];
    }

    public function update($id, $request)
    {
        $data = $request->except('_token');
        $user = $this->itemByIdentifier($id);
        if (isset($request->role_id) && ($user->id == 1 && $request->role_id != 1)) throw new RoleNotChangeableException;
        return $user->update($data);
    }

    public function delete($data)
    {
        if ($data == 1) throw new NotDeletableException();
        $user = $this->itemByIdentifier($data);
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

    public function findByEmailAndToken($email, $token)
    {
        try{
            $decryptedToken = decrypt($token);
        }
        catch(\Exception $e){
            throw new EncryptedPayloadException();
        }
        $user = $this->model->where('email', $email)->where('token', $decryptedToken)->first();
        if (!isset($user)) throw new ModelNotFoundException;
        return $user;
    }
}
