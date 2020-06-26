<?php

namespace App\Services;

use App\Exceptions\NotDeletableException;
use App\Http\Requests\system\userRequest;
use App\Model\Role;
use App\User;
use Illuminate\Support\Facades\Hash;

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
    public function getRoles(){
        return $this->role->orderBy('name', 'ASC')->get();
    }

    public function indexPageData($data)
    {
        return [
            'items' => $this->getAllData($data),
            'roles' => $this->getRoles()
        ];
    }

    public function createPageData($data)
    {
        return [
            'roles' => $this->getRoles()
        ];
    }

    public function store($request){
        $data = $request->except('_token');
        $data['password'] = isset($data['password']) ? Hash::make($data['password']) : null;
        return $this->model->create($data);
    }

    public function editPageData($data)
    {
        $user = $this->itemByIdentifier($data);
        return [
            'item' => $user,
            'roles' => $this->getRoles()
        ];
    }

    public function delete($data){
        if($data == 1) throw new NotDeletableException();
        $user = $this->itemByIdentifier($data);
        return $user->delete();
    }
}
