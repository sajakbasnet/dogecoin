<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name', 'attributes'
    ];

    protected static $logAttributes = ['name', 'attributes'];
    
    protected static $logName = 'Category';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        $authUser = authUser();
        $now = Carbon::now()->format('yy-m-d H:i:s');
        return "Category of id {$this->id} was {$eventName} by {$authUser->name} at {$now}.";
    }
}
