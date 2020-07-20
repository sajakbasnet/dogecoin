<?php

namespace App\Services;

use App\Model\Language;
use Spatie\TranslationLoader\LanguageLine;

class TranslationService extends Service
{
    public function __construct(LanguageLine $languageLine, LanguageService $languageService)
    {
        parent::__construct($languageLine);
        $this->languageService = $languageService;
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        $query = $this->query();
        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('key', 'LIKE', '%' . $data->keyword . '%');
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
        // dd(trans('hello :name test', ['name'=>'pramesh karmacharya']));
        $languages = $this->languageService->getAllData($data->only('group'), ['name', 'language_code'], false);
        return [
            'items' => $this->getAllData($data),
            'groups' => $this->languageService->defaultLanguageGroups(),
            'locales' => $this->languageService->getKeyValuePair($languages)
        ];
    }

    public function store($request)
    {
        $key = trim(strtolower($request->key));
        if($key !== ""){
            $check = $this->model::where('key', $key)->where('group', $request->group)->first();
            if (!isset($check)) {
                return $this->model::create([
                    'group' => $request->group,
                    'key' => $key,
                    'text' => $this->inserttext($key, $request->group),
                ]);
            }
        }else return true;
    }

    public function inserttext($content, $group)
    {
        $languages = Language::where('group', $group)->orderBy('group', 'ASC')->pluck('language_code');
        $text = array();
        foreach ($languages as $language) {
            $text[$language] = $content;
        }
        return $text;
    }

    public function update($id, $request)
    {
        
    }

    public function delete($id)
    {
        $item = $this->itemByIdentifier($id);
        return $item->delete();
    }


}
