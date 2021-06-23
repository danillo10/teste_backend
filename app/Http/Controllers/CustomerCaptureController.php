<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerCapture;
use App\Models\TypeUser;
use App\Http\Controllers\Auth\Helpers\Util;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Helpers\Utils;


class CustomerCaptureController extends Controller
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
            return Utils::buildReturnSuccessStatement(CustomerCapture::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(CustomerCapture::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                    'name' => 'required|unique:customer_capture,name|max:191',
                ]);

            return Utils::buildReturnSuccessStatement(CustomerCapture::create($request->all()));
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

            $customerCapture = CustomerCapture::find($id);
            $customerCapture->update($request->all());        
            return Utils::buildReturnSuccessStatement($customerCapture);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(CustomerCapture::destroy($id));
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) 
                return Utils::buildReturnErrorStatement('2020 - Esse objeto possui relacionamentos existentes');
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
