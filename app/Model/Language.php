<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name', 'language_code', 'group'
    ];

    public function isDefault()
    {
        if(in_array($this->language_code, ['en', 'ja'])) return true;
        else return false;
    }
}
