<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'attributes'
    ];

    public function getAllData($data){
        $query = $this->query();
        if($data->keyword !== null || isset($data->keyword)){
            $query->where('name', 'LIKE', '%'.$data->keyword.'%');
        }
        return $query->paginate(PAGINATE);
    }
}
