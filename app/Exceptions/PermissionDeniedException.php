<?php

namespace App\Exceptions;

use Exception;

class PermissionDeniedException extends Exception
{
    public function __construct(){

    }
    public function index(){
        return response()->view('system.errors.permissionDenied', ['error' => 'test'], 401);
    }
}
