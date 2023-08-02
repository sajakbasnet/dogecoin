<?php

namespace App\Interfaces\System;

interface TicketConsultInterface
{
    public function getAllData($data, $selectedColumns = [], $pagination = true);
    
    public function create($data);    

    public function message($data);
  
}
