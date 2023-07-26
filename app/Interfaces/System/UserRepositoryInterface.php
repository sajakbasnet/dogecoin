<?php

namespace App\Interfaces\System;
interface UserRepositoryInterface
{
    public function getAllData($data, $selectedColumns = [], $pagination = true);

    public function createUser($userData);

    public function updateUser($id, $userData);
 
    public function deleteUser($id);

    public function getRoles();

    public function generateToken($length);

    public function resetPassword($data);

    public function findByEmailAndToken($email, $token);

    public function findByEmail($email);
}
