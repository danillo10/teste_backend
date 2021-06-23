<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerBankAccount extends Model
{
    use HasFactory;
    protected $table = 'partner_bank_account';

    protected $fillable = 
    [
        'partner_id',
        'bank_account_id'
    ];

    public function partner() {

        return $this->belongsTo('App\Models\BankAccount');
    }
}
