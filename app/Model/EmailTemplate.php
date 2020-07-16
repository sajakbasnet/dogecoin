<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = [
        'title', 'code', 'from'
    ];

    public function emailTranslations(){
        return $this->hasMany(EmailTemplateTranslation::class, 'email_template_id', 'id');
    }

    public function getContentByLanguage($language_code, $key=null){
        $translations = $this->emailTranslations->where('language_code', $language_code)->first();
        if(isset($translations)){
            if($key != null){
                return $translations->$key;
            }else{
                return $translations;
            }
        } 
        else return null;
    }
}
