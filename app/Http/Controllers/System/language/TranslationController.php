<?php

namespace App\Http\Controllers\system\language;

use App\Exports\TranslationExport;
use App\Http\Controllers\system\ResourceController;
use App\Http\Requests\system\uploadExcel;
use App\Imports\TranslationImport;
use App\Services\TranslationService;
use Illuminate\Http\Request;
use Spatie\TranslationLoader\LanguageLine;

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
        $this->service->update($id, $request);
        return response()->json(["status" => "OK"],200);
    }

    public function downloadSample(){
        $file_path = public_path('sampleTranslation/sample.xls');
        return response()->download($file_path);
    }

    public function downloadExcel(Request $request, $group){
        if($group == "frontend") $filename = "frontend.xls";
        else $filename = "backend.xls";
        return \Excel::download(new TranslationExport($group), $filename);
    }

    public function uploadExcel(uploadExcel $request){
        $file = $request->excel_file;
        $fileExtension = $file->getClientOriginalExtension();
        if (!in_array($fileExtension, ['xlsx', 'xls'])) {
			return back()->withErrors(['alert-danger' => 'The file type must be xls or xlsx!']);
        }
        $contents = \Excel::import(new TranslationImport, $file);
        $uploadedData = $contents->toArray($contents, $file);
        dd($uploadedData);
    }
}
