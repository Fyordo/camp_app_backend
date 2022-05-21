<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationModel extends Model
{
    use HasFactory;

    protected $table = 'operations';

    protected $fillable = [
        'seller_id',
        'buyer_id',
        'sum',
    ];

    protected $visible = [
        'id',
        'seller_id',
        'buyer_id',
        'sum',
        'created_at',
        'updated_at',
    ];
}
