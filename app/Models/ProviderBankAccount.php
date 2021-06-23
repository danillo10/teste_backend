<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderBankAccount extends Model
{
    use HasFactory;
    protected $table = 'provider_bank_account';

    protected $fillable = 
    [
        'provider_id',
        'bank_account_id'
    ];

    public function provider() {

        return $this->belongsTo('App\Models\BankAccount');
    }
}
