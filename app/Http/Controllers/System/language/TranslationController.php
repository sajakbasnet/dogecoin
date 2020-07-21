<?php

namespace App\Http\Controllers\system\language;

use App\Http\Controllers\Controller;
use App\Http\Controllers\system\ResourceController;
use App\Http\Requests\system\translationRequest;
use App\Services\TranslationService;
use Illuminate\Http\Request;

class TranslationController extends ResourceController
{
    public function __construct(TranslationService $translationService)
    {
        parent::__construct($translationService, 'App\Http\Requests\system\translationRequest');
    }

    public function moduleName()
    {
        return 'translations';
    }

    public function viewFolder()
    {
        return 'system.translation';
    }

    public function update($id)
    {
        $request = app()->make($this->request);
        $data = $this->service->itemByIdentifier($id);
        $currentTextArray = $data->text;
        if(in_array($request->locale, array_keys($currentTextArray))){
            unset($currentTextArray[$request->locale]);
            $updatedTextArray = array_merge($currentTextArray, [$request->locale => $request->text]);
            $data->update(['group'=>$request->group,'text' => $updatedTextArray]);
        }else{
            $updatedTextArray = array_merge($currentTextArray, [$request->locale => $request->text]);
            $data->update(['group'=>$request->group,'text' => $updatedTextArray]);
        }
        return response()->json(["status" => "OK"],200);
    }

    public function downloadSample(){

    }

    public function downloadExcel(){
        
    }
}
