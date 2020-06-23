<?php

namespace App\Services;

use App\Model\Role;
use App\User;

class UserService extends Service
{
    public function __construct(User $user, Role $role)
    {
        $this->model = $user;
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

    public function indexPageData($data)
    {
        return [
            'items' => $this->getAllData($data),
            'roles' => $this->getRoles()
        ];
    }

    public function getRoles(){
        return $this->role->orderBy('name', 'ASC')->get();
    }
}
