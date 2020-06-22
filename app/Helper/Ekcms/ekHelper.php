<?php

use App\Model\Config as conf;
use Illuminate\Support\Facades\Auth;

class ekHelper{

    public static function prefix(){
        return Config::get('constants.PREFIX');
    }

    public static function authUser(){
        return Auth::user();
    }

    public static function getCmsConfig($label){
        $value = "";
        $data = conf::where('label', $label)->first();
        if(!isset($data) || $data == null){
            $value;
        }else $value = $data->value;
        return $value;
        
    }

    public static function hasPermission(){
    }

    public static function test(){
    }

}