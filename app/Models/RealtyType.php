<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealtyType extends Model
{
    use HasFactory;
    protected $table = 'realty_type';

    protected $fillable = 
    [
        'name',
    ];
}
