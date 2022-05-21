<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopModel extends Model
{
    use HasFactory;

    protected $table = 'shops';

    protected $fillable = [
        'seller_id',
        'title',
        'category'
    ];

    protected $visible = [
        'id',
        'seller_id',
        'title',
        'category'
    ];
}
