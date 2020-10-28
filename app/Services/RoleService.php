<?php

namespace App\Services;

use App\Exceptions\NotDeletableException;
use App\Model\Role;
use Config;

class RoleService extends Service
{
    public function __construct(Role $role)
    {
        parent::__construct($role);
    }

    public function mapPermission($permissions)
    {
        $mappedPermissions = [];
        foreach ($permissions as $permission) {
            $decoded = json_decode($permission);
            if(is_array($decoded)){
                foreach($decoded as $per){
                    array_push($mappedPermissions, $per);
                }
            }else{
                array_push($mappedPermissions, $decoded);  
            }
        }
        return $mappedPermissions;
    }
    public function getAllData($data, $selectedColumns=[], $pagination = true)
    {
        $query = $this->query();

        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('name', 'LIKE', '%' . $data->keyword . '%');
        }
        if(count($selectedColumns) > 0){
            $query->select($selectedColumns);
        }
        if ($pagination) return $query->orderBy('id', 'DESC')->with('users')->paginate(PAGINATE);
        return $query->orderBy('id', 'DESC')->with('users')->get();
    }

    public function indexPageData($request)
    {
        return ['items' => $this->getAllData($request)];
    }
    public function store($request)
    {
        $data = $request->except('_token');
        $data['permissions'] = $this->mapPermission($request->permissions);
        return $this->model->create($data);
    }
    public function editPageData($request, $id)
    {
        $role = $this->itemByIdentifier($id);
        return [
            'item' => $role
        ];
    }
    public function update($request, $id)
    {
        $role = $this->itemByIdentifier($id);
        $data = $request->except('_token');
        $data['permissions'] = $this->mapPermission($data['permissions']);
        return $role->update($data);
    }

    public function delete($request, $id)
    {
        $role = $this->itemByIdentifier($id);
        if($role->users->count() > 0) throw new NotDeletableException('The role is associated to the users.');
        return $role->delete();
    }

}
