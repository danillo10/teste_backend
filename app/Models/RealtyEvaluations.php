<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealtyEvaluations extends Model
{
    use HasFactory;

    protected $table = 'realty_evaluations';

    protected $fillable = 
    [
        'realty_id',
        'price_wanted',
        'price_m2',
        'price_m2_average',
        'price_m2_like',
        'location_details',
        'is_new',
        'electrical_installation',
        'hydraulic_installation',
        'painting',
        'finishing',
        'liners',
        'roofs',
        'glassware',
        'external_noises',
        'safety',
        'note',
    ];
}
