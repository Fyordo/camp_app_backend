<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffModel extends Model
{
    use HasFactory;

    protected $table = 'staff';

    protected $fillable = [
        'role',
        'user_id'
    ];

    protected $visible = [
        'id',
        'role',
        'user_id'
    ];
}
