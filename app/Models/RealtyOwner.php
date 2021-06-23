<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealtyOwner extends Model
{
    use HasFactory;
    protected $table = 'owner';

    protected $fillable = 
    [
        'status',
        'person',
        'name_social_reason',
        'cpf_cnpj',
        'email',
        'contact_phone',
        'contact_name',
        'address',
        'note',
    ];
}
