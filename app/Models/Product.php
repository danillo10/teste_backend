<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';

    protected $fillable = 
    [
        'id',
        'status',
        'nome',
        'description',
        'provider_id',
        'realty_id',
        'stock',
        'cost_price',
        'sale_price',
    ];
}
