<?php

use App\Model\Config as conf;

class ekHelper{
    public static function prefix(){
        return Config::get('constants.PREFIX');
    }

    public static function getCmsConfig($label){
        $value = "";
        $data = conf::where('label', $label)->first();
        if(!isset($data) || $data == null){
            $value;
        }else $value = $data->value;
        return $value;
        
    }
}