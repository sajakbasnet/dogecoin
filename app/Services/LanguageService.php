<?php

namespace App\Services;

use App\Model\Language;

class LanguageService extends Service
{
    public function __construct(Language $language)
    {
        parent::__construct($language);
    }

    public function getAllData($data, $pagination = true)
    {
        $query = $this->query();
        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where(function ($q) use ($data) {
                $q->where('name', 'LIKE', '%' . $data->keyword . '%')->orWhere('language_code', 'LIKE', '%' . $data->keyword . '%');
            });
        }
        if (isset($data->group) && $data->group !== null) {
            $query->where('group', $data->group);
        } else {
            $query->where('group', 'backend');
        }
        if ($pagination) return $query->orderBy('id', 'DESC')->paginate(PAGINATE);
        return $query->orderBy('id', 'DESC')->get();
    }

    public function indexPageData($data)
    {
        return [
            'items' => $this->getAllData($data),
            'groups' => $this->defaultLanguageGroups(),
        ];
    }
    
    public function defaultLanguageGroups()
    {
        return
            [
                'backend' => 'Backend',
                'frontend' => 'Frontend',
            ];
    }

    public function getBackendLanguages()
    {
        return $this->model->where('group', 'backend')->get();
    }

    public function getFrontendLanguages()
    {
        return $this->model->where('group', 'frontend')->get();
    }
}
