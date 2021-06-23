<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealtyAttachment extends Model
{
    use HasFactory;
    protected $table = 'realty_attachment';

    protected $fillable = 
    [
        'realty_id',
        'directory',
    ];

}
