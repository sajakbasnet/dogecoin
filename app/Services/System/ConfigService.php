<?php

namespace App\Services\System;

use App\Exceptions\NotDeletableException;
use App\Model\Config;
use App\Services\Service;
use App\Traits\ImageTrait;

class ConfigService extends Service
{
    use ImageTrait;

    public $dir = '/uploads/config';

    public function __construct(Config $config)
    {
        parent::__construct($config);
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        $query = $this->query();

        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('label', 'LIKE', '%'.$data->keyword.'%');
        }
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }
        if ($pagination) {
            return $query->orderBy('id', 'ASC')->paginate(PAGINATE);
        }

        return $query->orderBy('id', 'ASC')->get();
    }

    //config type key value pair
    public function configTypeOptions()
    {
        $mapped = [];
        foreach (configTypes() as $config) {
            $mapped[$config] = ucfirst($config);
        }

        return $mapped;
    }

    public function indexPageData($request)
    {
        return ['items' => $this->getAllData($request), 'types' => $this->configTypeOptions()];
    }

    public function store($request)
    {
        $data = $request->except('_token');
        if (strtolower($request->type) == 'file') {
            $data['value'] = $this->uploadImage($this->dir, 'value');
        }

        return $this->model->create($data);
    }

    public function update($request, $id)
    {
        $data = $request->except('_token');
        $config = $this->itemByIdentifier($id);
        if (strtolower($config->type) == 'file') {
            $this->removeImage($this->dir, $config->value);
            $data['value'] = $this->uploadImage($this->dir, 'value');
        }
        $config->update($data);
        setConfigCookie();

        return $config = $this->itemByIdentifier($id);
    }

    public function delete($request, $id)
    {
        $config = $this->itemByIdentifier($id);
        if (in_array($id, [1, 2, 3])) {
            throw new NotDeletableException;
        }
        if (strtolower($config->type) == 'file') {
            $this->removeImage($this->dir, $config->value);
        }

        return $config->delete();
    }
}
