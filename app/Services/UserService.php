<?php
namespace App\Services;

use App\User;

class UserService extends Service
{
    public function __construct(User $user){
        $this->model = $user;
    }

    public function getAllData($data)
    {
        $query = $this->query();
        return $query->orderBy('id', 'DESC')->paginate(PAGINATE);
    }

    public function indexPageData($data)
    {
       return  $this->getAllData($data);
    }
}