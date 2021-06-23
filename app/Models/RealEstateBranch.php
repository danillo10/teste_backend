<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstateBranch extends Model
{
    use HasFactory;

    protected $table = 'real_estate_branches';

    protected $fillable = 
    [
        'real_estate_agencies_id',
        'social_reason',
        'cnpj',
        'creci_number',
        'creci_data',
        'email',
        'is_agency',
        'contact_name',
        'contact_phone',
        'contact_cell',
        'customer_capture_id',
        'state_id',
        'city_id',
        'neighborhood_id',
        'zip_code',
        'address',
        'address_number',
        'complement',
        'reference_point',
    ];

    public function realEstateAgency() {

        return $this->belongsTo('App\Models\RealEstateAgency', 'real_estate_agencies_id');
    }
}
