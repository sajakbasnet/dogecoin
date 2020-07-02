<?php
namespace App\Services;

use App\Model\Config;

class ConfigService extends Service
{
    public function __construct(Config $config){
        $this->model = $config;
    }

    public function getAllData($data, $pagination = true)
    {
        $query = $this->query();

        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('label', 'LIKE', '%' . $data->keyword . '%');
        }
        if ($pagination) return $query->orderBy('id', 'ASC')->paginate(PAGINATE);
        return $query->orderBy('id', 'ASC')->get();
    }

    public function indexPageData($data)
    {
        return ['items' => $this->getAllData($data)];
    }
}