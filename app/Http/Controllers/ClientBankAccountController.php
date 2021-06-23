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

class ClientBankAccountController extends Controller
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
            return Utils::buildReturnSuccessStatement(ClientBankAccount::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(ClientBankAccount::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
            ]);

            $newbankAccounts = Utils::createBankForClass($request->bank_account, BankAccount::ClientBankAccount, $request->client_id);
            return Utils::buildReturnSuccessStatement($newbankAccounts->original);
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
            ]);

            $newbankAccounts = Utils::updateBankForClass(array_push($request->bank_account, ['client_bank_account' => $id]) , BankAccount::ClientBankAccount);
            return Utils::buildReturnSuccessStatement($newbankAccounts);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(ClientBankAccount::destroy($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
