<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealtyStatus extends Model
{
    use HasFactory;
    protected $table = 'realty_status';

    protected $fillable = 
    [
        'name',
    ];
}
