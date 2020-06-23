<?php

namespace App\Services;

use App\Model\Role;

class RoleService extends Service
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function getAllData($data, $pagination = true)
    {
        $query = $this->query();

        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('name', 'LIKE', '%' . $data->keyword . '%');
        }
        if ($pagination) return $query->orderBy('id', 'DESC')->with('users')->paginate(PAGINATE);
        return $query->orderBy('id', 'DESC')->with('users')->get();
    }

    public function indexPageData($data)
    {
        return ['items' => $this->getAllData($data)];
    }
}
