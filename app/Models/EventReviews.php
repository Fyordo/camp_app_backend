<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventReviews extends Model
{
    use HasFactory;

    protected $table = 'event_reviews';

    protected $fillable = [
        'reviewer_user_id',
        'event_id',
        'text',
    ];

    protected $visible = [
        'id',
        'reviewer_user_id',
        'event_id',
        'text',

        'created_at',
        'updated_at'
    ];
}
