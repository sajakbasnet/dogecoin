<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users(){
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    public function isEditable($id){
        return $id == 1 ? false : true; 
    }

    public function isDeletable($id){
        return $id == 1 ? false : true; 
    }

}
