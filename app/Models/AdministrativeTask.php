<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrativeTask extends Model
{
    use HasFactory;
    protected $table = 'administrative_tasks';

    protected $fillable = 
    [
        'status',
        'tag',
    ];
}
