<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use App\Models\RealtyEvaluations;
use App\Models\TypeUser;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RealtyEvaluationsController extends Controller
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
            return Utils::buildReturnSuccessStatement(RealtyEvaluations::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(RealtyEvaluations::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            return Utils::buildReturnSuccessStatement(RealtyEvaluations::create($request->all()));
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            return Utils::buildReturnSuccessStatement(RealtyEvaluations::find($id)->update($request->all()));
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
    
    public function destroy($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(RealtyEvaluations::destroy($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
