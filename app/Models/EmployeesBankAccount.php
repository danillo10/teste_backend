<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesBankAccount extends Model
{
    use HasFactory;
    protected $table = 'employees_bank_account';

    protected $fillable = 
    [
        'employee_id',
        'bank_account_id'
    ];

    public function employee() {

        return $this->belongsTo('App\Models\BankAccount');
    }
}
