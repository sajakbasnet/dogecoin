<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketConsult extends Model
{
    use HasFactory;
    protected $fillable = [
        'creator_id',
        'user_id',
        'message',
        'ticket_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
