<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    use HasFactory;

    public function usesTimestamps()
    {
        return false;
    }

    protected $table = "events";

    protected $fillable = [
        'title',
        'description',
        'beginning',
        'ending',
    ];

    protected $visible = [
        'id',
        'title',
        'description',
        'beginning',
        'ending',
    ];
}
