<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends Model
{
    use LogsActivity;

    protected $casts = [
        'permissions' => 'array',
    ];

    protected $fillable = [
        'name', 'permissions',
    ];

    protected static $logAttributes = ['name', 'permissions'];

    protected static $logName = 'Roles';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return logMessage('Role', $this->id, $eventName);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }

    public function isEditable($id)
    {
        return $id == 1 ? false : true;
    }

    public function isDeletable($ids)
    {
        return $ids == 1 ? false : true;
    }
}
