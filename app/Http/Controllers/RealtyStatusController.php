<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeUser;
use App\Http\Controllers\Auth\Helpers\Util;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Helpers\Utils;
use App\Models\RealtyStatus;

class RealtyStatusController extends Controller
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
            return Utils::buildReturnSuccessStatement(RealtyStatus::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(RealtyStatus::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                    'name' => 'required|unique:realty_status,name|max:191',
                ]);

            return Utils::buildReturnSuccessStatement(RealtyStatus::create($request->all()));
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
            ]);

            $realtyStatus = RealtyStatus::find($id);
            $realtyStatus->update($request->all());        
            return Utils::buildReturnSuccessStatement($realtyStatus);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(RealtyStatus::destroy($id));
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) 
                return Utils::buildReturnErrorStatement('2020 - Esse objeto possui relacionamentos existentes');
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
