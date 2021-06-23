<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheduling extends Model
{
    use HasFactory;
    protected $table = 'scheduling';

    protected $fillable = 
    [
        'status',
        'owner_id',
        'client_id',
        'partner_id',
        'start_date',
        'end_date',
        'action',
        'address',
        'note',
    ];
}
