<?php

namespace App\Services\System;

use App\Events\UserCreated;
use App\Exceptions\CustomGenericException;
use App\Exceptions\NotDeletableException;
use App\Exceptions\RoleNotChangeableException;
use App\Repositories\System\UserRepository;
use App\Services\Service;
use Illuminate\Support\Facades\Hash;

class UserService extends Service
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        return $this->userRepository->getAllData($data);
    }

    public function getRoles()
    {
        return $this->userRepository->getRoles();
    }

    public function indexPageData($request)
    {
        return [
            'items' => $this->getAllData($request),
            'roles' => $this->getRoles(),
        ];
    }

    public function createPageData($request)
    {
        return [
            'roles' => $this->getRoles(),
        ];
    }

    public function store($request)
    {
        \DB::transaction(function () use ($request) {
            $data = $request->except('_token');
            if ($request->set_password_status == '1') {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }
            $token = $this->userRepository->generateToken(24);
            $data['token'] = $token;
            $user = $this->userRepository->create($data);
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

    public function editPageData($request, $id)
    {
        $user = $this->userRepository->itemByIdentifier($id);
        return [
            'item' => $user,
            'roles' => $this->getRoles(),
        ];
    }

    public function update($request, $id)
    {
        try {
            $data = $request->except('_token');
            $user = $this->userRepository->itemByIdentifier($id);
            if (isset($request->role_id) && ($user->id == 1 && $request->role_id != 1)) {
                throw new RoleNotChangeableException('The role of the specific user cannot be changed.');
            }
            return $this->userRepository->update($user, $data);
        } catch (\Exception $e) {
            throw new CustomGenericException($e->getMessage());
        }
    }

    public function delete($request, $id)
    {
        if ($id == 1) {
            throw new NotDeletableException();
        }
        return $this->userRepository->delete($id);
    }
    public function findByEmailAndToken($email, $token)
    {
        return $this->userRepository->findByEmailAndToken($email, $token);
    }

    public function findByEmail($email)
    {
        return $this->userRepository->findByEmail($email);
    }

    public function resetPassword($request)
    {
        return $this->userRepository->resetPassword($request);
    }
    public function generateToken($length)
    {
        return $this->userRepository->generateToken($length);
    }
}
