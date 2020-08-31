<?php

namespace App\Model;

use Carbon\Carbon;
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
        $authUser = authUser();
        $now = Carbon::now()->format('yy-m-d H:i:s');
        return "Email template of id {$this->id} was {$eventName} by {$authUser->name} at {$now}.";
    }
}
