<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Page extends Model
{
    use HasFactory;

    use LogsActivity;

     protected $fillable = [
        'title', 'slug', 'status', 'image', 'description','meta_title', 'meta_description', 'keywords'
    ];

    protected static $logAttributes = ['title', 'slug', 'status', 'image','meta_title', 'meta_description'];

    protected static $logName = 'Page';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return logMessage('Page', $this->id, $eventName);
    }
}
