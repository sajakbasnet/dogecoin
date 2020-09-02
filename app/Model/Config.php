<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Config extends Model
{
    use LogsActivity;

    protected $fillable = [
        'label', 'type', 'value'
    ];

    protected static $logAttributes = ['label', 'type', 'value'];

    protected static $logName = 'Config';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        $authUser = authUser();
        $now = Carbon::now()->format('yy-m-d H:i:s');
        return "Config of id {$this->id} was <strong>{$eventName}</strong> by {$authUser->name} at {$now}.";
    }
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
        if (in_array($id, [1, 2, 3])) return true;
        else return false;
    }
}
