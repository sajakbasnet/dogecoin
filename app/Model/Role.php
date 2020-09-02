<?php

namespace App\Model;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Role extends Model
{
    use LogsActivity;
    protected $casts = [
        'permissions' => 'array'
    ];
    protected $fillable = [
        'name', 'permissions'
    ];

    protected static $logAttributes = ['name', 'permissions'];
    
    protected static $logName = 'Roles';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        $authUser = authUser();
        $now = Carbon::now()->format('yy-m-d H:i:s');
        return "Role of id {$this->id} was <strong>{$eventName}</strong> by {$authUser->name} at {$now}.";
    }

    public function users(){
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    public function isEditable($id){
        return $id == 1 ? false : true; 
    }

    public function isDeletable($id){
        return $id == 1 ? false : true; 
    }

}
