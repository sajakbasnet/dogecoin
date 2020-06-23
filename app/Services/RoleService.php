<?php
namespace App\Services;

use App\Model\Role;

class RoleService extends Service
{
    public function __construct(Role $role){
        $this->model = $role;
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