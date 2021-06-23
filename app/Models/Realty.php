<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realty extends Model
{
    use HasFactory;

    protected $table = 'realty';

    protected $fillable =
    [
        'real_estate_branches_id',
        'owner_id',
        'realty_type_id',
        'realty_status_id',
        'available',
        'name',
        'key_possession',
        'key_possession_name',
        'key_possession_contact',
        'contact_name',
        'contact_phone',
        'contact_cell',
        'type_contract',
        'cadastral_index',
        'qty_bedrooms',
        'qty_garage',
        'qty_bathroom',
        'qty_suite',
        'qty_pavement',
        'living_room',
        'kitchen',
        'pool',
        'recreation_area',
        'barbecue_grill',
        'sports_court',
        'sports_field',
        'barbecue_grill',
        'sala_copa',
        'tv_room',
        'balcony',
        'gourmet_balcony',
        'sunny_period',
        'positive_points',
        'negative_points',
        'flexibility_trading',
        'registered',
        'commission',
        'total_area',
        'delivery_forecast',
        'zip_code',
        'address',
        'address_number',
        'complement',
        'reference_point',
        'neighborhood_id',
        'city_id',
        'state_id',
        'customer_capture_id',
        'price',
        'rent_price',
        'bank_appraisal_price',
        'condo_price',
        'iptu_price',
        'max_price_financed',
        'max_qty_parcels'
    ];

    public function realtyEvaluations()
    {
        return $this->hasMany('App\Models\RealtyEvaluations', 'realty_id');
    }
}
