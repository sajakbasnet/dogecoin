<?php

namespace App\Interfaces;

interface OpenInterface
{
    public function getAllData($data, $selectedColumns = [], $pagination = true);

    public function create($userData);  

    public function update($id, $userData);

    public function delete($id);
}
