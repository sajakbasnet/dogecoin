<?php

namespace App;

use App\Model\Role;
use App\Model\UserPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Config;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'role_id', 'token', 'password_resetted'
    ];

    protected static $logAttributes = ['name', 'email', 'password', 'username', 'role_id'];
    
    protected static $logName = 'User';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Model has been {$eventName}";
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function userPasswords()
    {
        return $this->hasMany(UserPassword::class, 'user_id', 'id');
    }

    public function getPasswordSetResetLink($check = false, $token)
    {
        $title = 'Reset Password';
        $key = 'reset-password';
        if ($check) {
            $title = 'Set Password';
            $key = 'set-password';
        }
        return "<a href=" . Config::get('constants.URL') . "/" . Config::get('constants.PREFIX') . "/" . $key . "/" . $this->email . "/" . $token . ">" . $title . "</a>";
    }
}
