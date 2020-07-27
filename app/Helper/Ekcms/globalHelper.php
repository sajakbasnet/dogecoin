<?php

use App\Model\Config as conf;
use App\Model\Language;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;

function authUser()
{
    return Auth::user();
}
function getCmsConfig($label)
{
    $value = "";
    $data = conf::where('label', $label)->first();
    if (!isset($data) || $data == null) {
        $value;
    } else $value = $data->value;
    return $value;
}
function generateToken($length)
{
    return bin2hex(openssl_random_pseudo_bytes($length));
}

function showInSideBar($check)
{
    return $check;
}

function modules()
{
    $modules = Config::get('cmsConfig.modules');
    return $modules;
}

function configTypes()
{
    return ['file', 'text', 'textarea', 'number'];
}

function getCountries()
{
    $http = new Client();
    $response = $http->get('https://restcountries.eu/rest/v2/all');
    $countries = (\GuzzleHttp\json_decode($response->getBody()->getContents()));
    return transformCountries($countries);
}

function transformCountries($countries)
{
    $transformedCountries = [];
    foreach ($countries as $key => $value) {
        $transformedCountries[$key]['name'] = $value->name;
        $transformedCountries[$key]['alpha_code'] = $value->alpha2Code;
        $transformedCountries[$key]['alpha_code_3'] = $value->alpha3Code;
        $transformedCountries[$key]['native_name'] = $value->nativeName;
        $transformedCountries[$key]['alternate_spellings'] = json_encode($value->altSpellings, JSON_UNESCAPED_SLASHES);
        $transformedCountries[$key]['calling_codes'] = json_encode($value->callingCodes, JSON_UNESCAPED_SLASHES);
        $transformedCountries[$key]['currencies'] = json_encode($value->currencies, JSON_UNESCAPED_SLASHES);
        $transformedCountries[$key]['languages'] = json_encode($value->languages, JSON_UNESCAPED_SLASHES);
        $transformedCountries[$key]['flag'] = $value->flag;
    }
    return $transformedCountries;
}

function isPermissionSelected($permission, $permissions)
{
    $permission = json_decode($permission);
    $permissions = json_decode($permissions);
    $check = false;
    if (!is_array($permission)) {
        if ($permissions != null) {
            $exists = in_array($permission, $permissions);
            if ($exists) $check = true;
        }
    } else {
        $temCheck = false;
        if ($permissions != null) {
            foreach ($permission as $perm) {
                $exists = in_array($perm, $permissions);
                if ($exists) $temCheck = true;
            }
        }
        $check = $temCheck;
    }
    return $check;
}

function routeExists($route)
{
    $slugs  = [];
    $routes = Route::getRoutes();

    foreach ($routes as $route) {
        $slugs[] = '/' . $route->uri();
    }
    if (in_array('"/administrator/users/create"', array_unique($slugs)))
        return true;

    else return false;
}

