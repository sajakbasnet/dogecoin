<?php

namespace App\Interfaces\System;

interface TicketInterface
{
    public function getAllData($data, $selectedColumns = [], $pagination = true);
    
    public function create($data);    

    public function update($id, $data);

    public function delete($request,$id);

    public function getUser();

    public function generateCode();
}
