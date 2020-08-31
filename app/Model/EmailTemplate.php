<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class EmailTemplate extends Model
{
    use LogsActivity;
    
    protected $fillable = [
        'title', 'code', 'from'
    ];

    protected static $logAttributes = ['title', 'code', 'from'];
    
    protected static $logName = 'Email Template';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Model has been {$eventName}";
    }

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
