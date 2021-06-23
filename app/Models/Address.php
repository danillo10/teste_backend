<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'address_view';

    protected $fillable = 
    [
        'state_id',
        'state',
        'city_id',
        'city',
        'neighborhood_id',
        'neighborhood',
    ];
}
