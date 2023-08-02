<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'tickets';
    protected $fillable = [
        'subject',
        'description',
        'status',
        'createdDate',
        'user_id',
        'ticket_id',
        'priority'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
