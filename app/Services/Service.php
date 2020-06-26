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

    public function store($request)
    {
        return $this->model->create($request->except('_token'));
    }

    // store bulk records

    public function storeBulk($data)
    {
        return $this->model->createMany($data);
    }

    //update record

    public function update($id, $data)
    {
        $data = $data->except('_token');
        $update = $this->itemByIdentifier($id);
        return $update->fill($data)->save();
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
