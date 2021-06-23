<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientBankAccount extends Model
{
    use HasFactory;
    protected $table = 'client_bank_account';

    protected $fillable = 
    [
        'client_id',
        'bank_account_id'
    ];

    public function client() {

        return $this->belongsTo('App\Models\BankAccount');
    }
}
