<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\TypeUser;
use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use App\Models\AdministrativeTask;
use App\Models\BankAccount;
use App\Models\DocumentsAdministrative;
use App\Models\Employees;
use App\Models\RouterS3;

class EmployeesController extends Controller
{
    private $types = [
        TypeUser::ADMIN
    ];

    public function __construct()
    {
        $this->middleware(Util::buildRoles($this->types));
    }

    public function index()
    {
        try {
            return Utils::buildReturnSuccessStatement(Employees::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(Employees::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:191',
                'cpf' => 'required|unique:employees,cpf',
                'type_employee' => 'required',
                'office_id' => 'required',
                'salary_gross' => 'required',
                'person' => 'required',
                'email' => 'required|email:rfc,dns|unique:employees,email',
                'date_admission' => 'required',
                'contact_phone' => 'required|numeric',
                'contact_cell' => 'numeric',
                'zip_code' => 'required|numeric|digits:8',
                'address' => 'required',
                'address_number' => 'required|numeric',
                'neighborhood' => 'required',
                'city' => 'required',
                'state' => 'required'
            ]);

            $employees = Employees::create($request->all());
            $newbankAccounts = [];

            if ($request->has('bank_account'))
                $newbankAccounts = Utils::createBankForClass($request->get('bank_account'),BankAccount::EmployeesBankAccount, $employees['id']);

            return Utils::buildReturnSuccessStatementArray($employees, "BankAccounts", $newbankAccounts->original);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|max:191',
                'cpf' => 'required',
                'type_employee' => 'required',
                'office_id' => 'required',
                'salary_gross' => 'required',
                'person' => 'required',
                'email' => 'required|email:rfc,dns',
                'date_admission' => 'required',
                'contact_phone' => 'required|numeric',
                'contact_cell' => 'numeric',
                'zip_code' => 'required|numeric|digits:8',
                'address' => 'required',
                'address_number' => 'required|numeric',
                'neighborhood' => 'required',
                'city' => 'required',
                'state' => 'required'
            ]);

            $employees = Employees::find($id);
            $employees->update($request->all());
            $newbankAccounts = [];

            if ($request->has('bank_account'))
                $newbankAccounts = Utils::updateBankForClass($request->get('bank_account'),BankAccount::EmployeesBankAccount);

            return Utils::buildReturnSuccessStatementArray($employees, "BankAccounts", $newbankAccounts->original);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(Employees::destroy($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
