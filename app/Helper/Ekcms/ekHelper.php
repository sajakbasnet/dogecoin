<?php

use App\Model\Config as conf;

    function prefix(){
        return Config::get('constants.PREFIX');
    }

    function getCmsConfig($label){
        $value = "";
        $data = conf::where('label', $label)->first();
        if(!isset($data) || $data == null){
            $value;
        }else $value = $data->value;
        return $value;
        
    }