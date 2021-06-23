<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use App\Models\BankAccount;
use App\Models\Owner;
use App\Models\OwnerBankAccount;
use Illuminate\Validation\ValidationException;
use App\Models\TypeUser;
use Illuminate\Http\Request;

class OwnerController extends Controller
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
            return Utils::buildReturnSuccessStatement(Owner::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(Owner::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name_social_reason' => 'required|max:191',
                'cpf_cnpj' => 'required|unique:owner,cpf_cnpj',
                'person' => 'required',
                'email' => 'required|email:rfc,dns|unique:owner,email',
                'contact_phone' => 'required|numeric',
                'contact_cell' => 'numeric',
                'zip_code' => 'required|numeric|digits:8',
                'address' => 'required',
                'address_number' => 'required|numeric',
                'neighborhood' => 'required',
                'city' => 'required',
                'state' => 'required'
            ]);

            $adress = AddressController::getAddress($request);
            $owner = Owner::create(array_merge($request->all(), $adress->toArray()));

            if ($request->has('bank_account'))
                Utils::createBankForClass($request->get('bank_account'),BankAccount::OwnerBankAccount, $owner['id']);

            return Utils::buildReturnSuccessStatement($owner);
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
                'name_social_reason' => 'required|max:191',
                'cpf_cnpj' => 'required',
                'person' => 'required',
                'email' => 'required|email:rfc,dns',
                'contact_phone' => 'required|numeric',
                'contact_cell' => 'numeric',
                'zip_code' => 'required|numeric|digits:8',
                'address' => 'required',
                'address_number' => 'required|numeric',
                'neighborhood' => 'required',
                'city' => 'required',
                'state' => 'required'
            ]);

            $adress = AddressController::getAddress($request);
            $owner = Owner::find($id);
            $owner->update(array_merge($request->all(), $adress->toArray()));
            
            if ($request->has('bank_account'))
                Utils::updateBankForClass($request->get('bank_account'),BankAccount::OwnerBankAccount);

            return Utils::buildReturnSuccessStatement($owner, "BankAccounts");
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(Owner::destroy($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
