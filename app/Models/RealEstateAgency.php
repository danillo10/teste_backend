<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstateAgency extends Model
{
    use HasFactory;
    protected $table = 'real_estate_agencies';

    protected $fillable = 
    [
        'social_reason',
        'cnpj'
    ];

    public function realEstateBranchs()
    {
        return $this->hasMany('App\Models\RealEstateBranch', 'real_estate_agencies_id');
    }
}
    