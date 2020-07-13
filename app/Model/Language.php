<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name', 'language_code', 'group'
    ];

    public function isDefault($language_code)
    {
        if(in_array($language_code, ['en', 'ja'])) return true;
        else return false;
    }
}
