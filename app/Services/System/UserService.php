<?php

namespace App\Services\System;

use App\Repositories\System\UserRepository;
class UserService 
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
        return $this->userRepository->createUser($request);
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
        return $this->userRepository->updateUser($id, $request);
    }

    public function delete($request, $id)
    {
        return $this->userRepository->deleteUser($id);
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
}
