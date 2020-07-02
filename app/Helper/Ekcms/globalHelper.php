<?php
use App\Model\Config as conf;

function authUser(){
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
function generateToken($length){
    return bin2hex(openssl_random_pseudo_bytes($length));
}

function showInSideBar($check)
    {
        return $check;
    }

function modules(){
    $modules = Config::get('cmsConfig.modules');
    return $modules;
}

function configTypes(){
    return ['file', 'text', 'textarea', 'number'];
}