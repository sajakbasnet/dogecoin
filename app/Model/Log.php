<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;

class Log extends Activity
{
    protected $table = 'activity_log';

    public function getModuleName($data)
    {
        if (isset($data)) {
            $data = explode("\\", $data);
            $moduleName = $data[array_key_last($data)];
        } else {
            $moduleName = 'N/A';
        }
        return $moduleName;
    }

    public function user(){
        return $this->belongsTo(User::class, 'causer_id', 'id');
    }
}
