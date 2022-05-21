<?php

namespace App\Models\Traits;

use App\Models\User;

trait WithUser
{
    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }
}
