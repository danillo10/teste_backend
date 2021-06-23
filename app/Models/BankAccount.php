<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    const ClientBankAccount     = 0;
    const EmployeesBankAccount  = 1;
    const OwnerBankAccount      = 2;
    const PartnerBankAccount    = 3;
    const ProviderBankAccount   = 4;
    const RealEstateBankAccount = 5;
    const RealtorBankAccount    = 6;

    use HasFactory;
    protected $table = 'bank_account';

    protected $fillable = 
    [
        'bank_id',
        'type_account',
        'cpf_cnpj',
        'agency',
        'account',
        'balance'
    ];
    
}
