<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCapture extends Model
{
    use HasFactory;

    protected $table = 'customer_capture';

    protected $fillable = 
    [
        'name',
    ];
}
