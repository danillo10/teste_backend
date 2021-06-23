<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealtyMedia extends Model
{
    use HasFactory;
    protected $table = 'realty_media';

    protected $fillable = 
    [
        'realty_id',
        'directory',
    ];
}
