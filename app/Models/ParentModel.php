<?php

namespace App\Models;

use App\Models\Traits\WithChildren;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    use HasFactory;
    use WithChildren;

    protected $table = "parents";

    protected $fillable = [
        'user_id'
    ];

    protected $visible = [
        'id',
        'user_id'
    ];
}
