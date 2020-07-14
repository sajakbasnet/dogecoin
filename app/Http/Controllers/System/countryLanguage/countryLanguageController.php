<?php

namespace App\Http\Controllers\system\countryLanguage;

use App\Http\Controllers\Controller;
use App\Services\CountryService;
use Illuminate\Http\Request;

class countryLanguageController extends Controller
{
    public function __construct(CountryService $countryService){
        $this->countryService = $countryService;
    }

    public function getLanguages($countryId){
        $languages = $this->countryService->itemByIdentifier($countryId);
        return response()->json(['languages' => json_decode($languages->languages)]);
    }
}
