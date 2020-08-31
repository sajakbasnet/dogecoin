<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class EmailTemplateTranslation extends Model
{
    use LogsActivity;
    
    protected $fillable = [
        'email_template_id', 'language_code', 'subject', 'template'
    ];


    protected static $logAttributes = ['subject', 'template'];
    
    protected static $logName = 'Email Template';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Model has been {$eventName}";
    }
}
