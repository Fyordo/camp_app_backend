<?php

namespace App\Models;

use App\Models\Traits\WithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use WithUser;
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
    ];

    protected $visible = [
        'sender_id',
        'receiver_id',
        'message',
    ];
}
