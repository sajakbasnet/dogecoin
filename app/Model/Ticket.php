<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Ticket extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'tickets';
    protected $fillable = [
        'subject',
        'description',
        'status',
        'createdDate',
        'user_id',
        'ticket_id',
        'priority',
        'assigned_id',
        'class'
    ];
    protected static $logName = 'Ticket';
    protected static $logAttributes = ['subject', 'description', 'priority'];
    public function user()
    {
        return $this->belongsTo(User::class,'assigned_id','id');
    }
    public function getDescriptionForEvent(string $eventName): string
    {
        return logMessage('Ticket', $this->id, $eventName);
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn (string $eventName) => $this->getDescriptionForEvent($eventName))
        ->useLogName(self::$logName)
        ->logOnly(self::$logAttributes)
        ->logOnlyDirty();
    }
}
  
