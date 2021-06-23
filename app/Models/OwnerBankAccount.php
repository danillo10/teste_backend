<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerBankAccount extends Model
{
    use HasFactory;
    protected $table = 'owner_bank_account';

    protected $fillable = 
    [
        'owner_id',
        'bank_account_id'
    ];

    public function owner() {

        return $this->belongsTo('App\Models\BankAccount');
    }
}
