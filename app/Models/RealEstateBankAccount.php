<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstateBankAccount extends Model
{
    use HasFactory;
    protected $table = 'real_estate_bank_account';

    protected $fillable = 
    [
        'real_estate_branches_id',
        'bank_account_id'
    ];
}
