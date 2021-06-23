<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected $table = 'employees';

    protected $fillable = 
    [  
        'status',
        'type_employee',
        'office_id',
        'salary_gross',
        'name',
        'cpf',
        'email',
        'date_admission',
        'date_resignation',
        'contact_name',
        'contact_phone',
        'contact_cell',
        'zip_code',
        'address',
        'address_number',
        'complement',
        'reference_point',
        'neighborhood_id',
        'city_id',
        'state_id',
    ];

    public function employeesBankAccount()
    {
        return $this->hasMany('App\Models\EmployeesBankAccount');
    }
}
