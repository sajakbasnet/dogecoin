<?php

namespace App\Services;

use App\Model\Log;
use Config;

class LogService extends Service
{
    public function __construct(Log $log)
    {
        parent::__construct($log);
    }

    public function getAllData($data, $selectedColumns=[], $pagination=true)
    {
        $query = $this->query();
        if(count($selectedColumns) > 0){
            $query->select($selectedColumns);
        }
        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('name', 'LIKE', '%' . $data->keyword . '%');
        }
        if($pagination){
            return $query->orderBy('id', 'DESC')->with('user')->paginate(Config::get('constants.PAGINATION'));
        }else{
            return $query->get();
        }
        
    }

    public function indexPageData($data)
    {
        return [
            'items' => $this->getAllData($data)
        ];
    }
}
