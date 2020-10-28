<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'attributes', 'parent_id'
    ];

    public function getAllData($data){
        $query = $this->query();
        if($data->keyword !== null || isset($data->keyword)){
            $query->where('name', 'LIKE', '%'.$data->keyword.'%');
        }
        return $query->paginate(PAGINATE);
    }

    public function subCategoryCount($id){
        return $this->where('parent_id', $id)->count();
    }
}
