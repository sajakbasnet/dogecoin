<?php

namespace App\Services;

use App\Model\Country;
use App\Model\Language;

class LanguageService extends Service
{
    public function __construct(Language $language, CountryService $countryService)
    {
        parent::__construct($language);
        $this->countryService = $countryService;
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
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
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
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

    public function createPageData($data)
    {
        $countries = $this->countryService->getAllData($data, ['id', 'name', 'languages', 'flag'], false);
        return [
            'countriesOptions' => $this->countryService->extractKeyValuePair($countries),
            'groups' => $this->defaultLanguageGroups(),
        ];
    }

    public function store($request)
    {
        $country = $this->countryService->itemByIdentifier($request->get('country_id'));
        $languages = json_decode($country->languages);
        foreach ($languages as $language) {
            if ($language->iso639_1 == $request->get('language_code')) {
                $name = $language->name;
                $language_code = $language->iso639_1;
                break;
            }
        }
        return $this->model->create([
            'name' => $name,
            'language_code' => $language_code,
            'group' => $request->get('group')
        ]);
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
