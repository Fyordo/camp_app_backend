<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaderModel extends Model
{
    use HasFactory;

    protected $table = "leaders";

    protected $fillable = [
        'user_id'
    ];

    protected $visible = [
        'id',
        'user_id'
    ];
}
