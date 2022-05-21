<?php

namespace App\Models\Traits;

use App\Models\Message;

trait WithMessages
{
    public function messages()
    {
        return $this->hasMany(Message::class, 'receiver_id', 'id');
    }
}
