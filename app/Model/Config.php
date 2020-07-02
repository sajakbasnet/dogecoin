<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
        'label', 'type', 'value'
    ];

    public function isFile($type)
    {
        if (strtolower($type) == 'file') return true;
        else return false;
    }
    public function isText($type)
    {
        if (strtolower($type) == 'text') return true;
        else return false;
    }
    public function isTextArea($type)
    {
        if (strtolower($type) == 'textarea') return true;
        else return false;
    }
    public function isNumber($type)
    {
        if (strtolower($type) == 'number') return true;
        else return false;
    }
    public function isColorPicker($id)
    {
        if ($id == '3') return true;
        else return false;
    }
    public function isDefault($id)
    {
        if (in_array($id, [1,2,3])) return true;
        else return false;
    }
}
