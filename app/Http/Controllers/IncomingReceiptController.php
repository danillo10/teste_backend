<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use App\Models\BankAccount;
use App\Models\IncomingReceipt;
use App\Models\IncomingReceiptItem;
use App\Models\TypeUser;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class IncomingReceiptController extends Controller
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
            return Utils::buildReturnSuccessStatement(IncomingReceipt::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                //TODO VALIDATE (VALIDAR REGRA DE NEGOCIO, PODENDO HAVER ALTERAÇÃO NA MIGRATION)
            ]);

            $incomingReceipt = IncomingReceipt::create($request->all());
                            
            foreach ($request->incomingReceiptItem as $incomingReceiptItem) {
                IncomingReceiptItem::create(array_merge($incomingReceiptItem, ['incoming_receipt_id' => $incomingReceipt->id]));
            } 
            
            return Utils::buildReturnSuccessStatement(IncomingReceipt::create($request->all()));
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return IncomingReceipt::find($id);
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                //TODO VALIDATE (VALIDAR REGRA DE NEGOCIO, PODENDO HAVER ALTERAÇÃO NA MIGRATION)
            ]);
            
            $incomingReceipt = IncomingReceipt::find($id)->update($request->all());

            foreach ($request->incomingReceiptItem as $incomingReceiptItem) {
                IncomingReceiptItem::find($incomingReceiptItem->id)->update($incomingReceiptItem);
            } 

            return Utils::buildReturnSuccessStatement($incomingReceipt);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e){
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(IncomingReceipt::destroy($id));
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) 
                return Utils::buildReturnErrorStatement('2020 - Esse objeto possui relacionamentos existentes');
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
