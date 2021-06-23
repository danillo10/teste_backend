<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\TypeUser;
use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use App\Models\BankAccount;

class BankAccountController extends Controller
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
            return Utils::buildReturnSuccessStatement(BankAccount::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(BankAccount::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'bank_id' => 'required',
                'type_account' => 'required',
                'cpf_cnpj' => 'required|',
                'agency' => 'required|numeric',
                'account' => 'required|numeric',
                'balance' => 'required|numeric',
            ]);
            
            return Utils::buildReturnSuccessStatement(BankAccount::create($request->all()));
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
                'agency' => 'numeric',
                'account' => 'numeric',
                'balance' => 'numeric',
            ]);

            $bankAccount = BankAccount::find($id)->update($request->all());
            return Utils::buildReturnSuccessStatement($bankAccount);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e){
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            BankAccount::destroy($id);
            return Utils::buildReturnSuccessStatement('Conta bancaria excluida com sucesso.');

        } catch (\Exception $e) {
            if ($e->getCode() == 23000) 
                return Utils::buildReturnErrorStatement('2020 - Esse objeto possui relacionamentos existentes');
                
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function storeGetById($request)
    {
        try {    
            $bankAccount = BankAccount::create($request);
            return $bankAccount['id'];

        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        }
        catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
