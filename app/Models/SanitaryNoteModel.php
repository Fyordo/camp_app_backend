<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanitaryNoteModel extends Model
{
    use HasFactory;

    protected $table = 'sanitary_notes';

    protected $fillable = [
        'child_user_id',
        'medic_user_id',
        'description',
    ];

    protected $visible = [
        'id',
        'child_user_id',
        'medic_user_id',
        'description',
        'created_at',
        'updated_at'
    ];
}
