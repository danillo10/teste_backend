<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealtorBankAccount extends Model
{
    protected $table = 'realtor_bank_account';

    protected $fillable = 
    [
        'realtor_id',
        'bank_account_id'
    ];

    public function realtor() {

        return $this->belongsTo('App\Models\BankAccount');
    }
}
