<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realtor extends Model
{
    protected $table = 'realtor';

    protected $fillable = 
    [  
        'status',
        'external_realtor',
        'real_estate_branches_id',
        'name_social_reason',
        'cpf_cnpj',
        'email',
        'creci_number',
        'creci_data',
        'fixed_commission',
        'percentage_commission',
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
        'customer_capture_id'
    ];

    public function realotorBankAccount()
    {
        return $this->hasMany('App\Models\ClientBankAccount');
    }
}
