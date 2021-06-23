<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    protected $table = 'partners';

    protected $fillable = 
    [  
        'status',
        'name_social_reason',
        'person',
        'profile_partner',
        'cpf_cnpj',
        'email',
        'creci_number',
        'creci_data',
        'percentage_commission',
        'fixed_commission',
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
    public function partnerBankAccount()
    {
        return $this->hasMany('App\Models\PartnerBankAccount', 'id');
    }
}
