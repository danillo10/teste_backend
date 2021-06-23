<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';

    protected $fillable = 
    [  
        'status',
        'name_social_reason',
        'person',
        'cpf_cnpj',
        'email',
        'income_revenues',
        'contact_name',
        'contact_phone',
        'contact_cell',
        'zip_code',
        'address',
        'address_number',
        'complement',
        'reference_point',
        'neighborhood_id',
        'city_id',
        'state_id',
        'customer_capture_id',
    ];
    
    public function clientBankAccount()
    {
        return $this->hasMany('App\Models\ClientBankAccount');
    }
}
