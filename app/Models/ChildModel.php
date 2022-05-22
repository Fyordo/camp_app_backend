<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ChildModel extends Model
{
    use HasFactory;

    protected $table = 'children';

    protected $fillable = [
        'parent_id',
        'user_id',
        'points',
        'longitude',
        'latitude',
        'updated_at'
    ];

    protected $visible = [
        'id',
        'parent_id',
        'user_id',
        'points',
        'longitude',
        'latitude',
        'created_at',
        'updated_at',
    ];
}
