<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\TypeUser;
use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use App\Http\Controllers\BankAccountController;
use App\Models\BankAccount;
use App\Models\Client;
use App\Models\ClientBankAccount;
use Symfony\Contracts\Service\Attribute\Required;

class ClientController extends Controller
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
            return Utils::buildReturnSuccessStatement(Client::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(Client::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name_social_reason' => 'required|max:191',
                'cpf_cnpj' => 'required|unique:clients,cpf_cnpj',
                'person' => 'required',
                'email' => 'required|email:rfc,dns|unique:clients,email',
                //'income_revenues' => 'required',
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
            $client = Client::create(array_merge($request->all(), $adress->toArray()));
            $newbankAccounts = [];
            
            if ($request->has('bank_account'))
                $newbankAccounts = Utils::createBankForClass($request->get('bank_account'),BankAccount::ClientBankAccount, $client['id']);

            return Utils::buildReturnSuccessStatementArray($client, "BankAccounts", $newbankAccounts->original);
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
                'name_social_reason' => 'max:191',
                'email' => 'email:rfc,dns',
                'contact_phone' => 'numeric',
                'contact_cell' => 'numeric',
                'zip_code' => 'numeric|digits:8',
            ]);

            $adress = AddressController::getAddress($request);
            $client = Client::find($id);
            $client->update(array_merge($request->all(), $adress->toArray()));
            $newbankAccounts = [];

            if ($request->has('bank_account'))
                $newbankAccounts = Utils::updateBankForClass($request->get('bank_account'),BankAccount::ClientBankAccount);

            return Utils::buildReturnSuccessStatementArray($client, "BankAccounts", $newbankAccounts->original);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(Client::destroy($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
