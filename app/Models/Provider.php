<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'providers';
    
    protected $fillable = 
    [
        'name_social_reason',
        'status',
        'person',
        "cpf_cnpj",
        "neighborhood_id",
        "city_id",
        "state_id",
        "customer_capture_id",
        "email",
        "contact_name",
        "contact_phone",
        "contact_cell",
        "zip_code",
        "address",
        "address_number",
        "complement",
        'reference_point',
        'plan_account_id',
        "created_at",
        "updated_at"
    ];

    public function providerBankAccount()
    {
        return $this->hasMany('App\Models\ProviderBankAccount');
    }
}

