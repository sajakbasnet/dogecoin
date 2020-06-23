<?php

namespace App\Services;
use Config;

class Service
{
    /**
     * Stores the model used for service
     * @var Eloquent object
     */
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    // get all data 

    public function getAllData($data, $pagination=true)
    {
        $query = $this->query();
        return $query->paginate(Config::get('constants.PAGINATION'));
    }

    // find model by its identifier

    public function find($id)
    {
        return $this->model->find($id);
    }

    //store single record

    public function store($data)
    {
        return $this->model->create($data);
    }

    // store bulk records

    public function storeBulk($data)
    {
        return $this->model->createMany($data);
    }

    //update record

    public function update($id, $data)
    {
        $update = $this->model->itemByIdentifier($id);
        $update->fill($data)->save();
        return $update;
    }

    //delete a record

    public function delete($id)
    {
        $item = $this->itemByIdentifier($id);
        return $item->delete();
    }

    //Get intem by its identifier

    public function itemByIdentifier($id)
    {
        return $this->model->findOrFail($id);
    }

    // Data for index page

    public function indexPageData($data)
    {
    }

    // Data for create page

    public function createPageData($data)
    {
    }

    // Data for edit page

    public function editPageData($id)
    {
        $item = $this->itemByIdentifier($id);
        return $item;
    }

    // get query for modal 

    public function query()
    {
        return $this->model->query();
    }
}
