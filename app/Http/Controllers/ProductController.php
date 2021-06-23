<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use App\Models\Product;
use App\Models\TypeUser;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
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
            return Utils::buildReturnSuccessStatement(Product::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'status' => 'required',
                'nome' => 'required',
                'sale_price' => 'required',
            ]);
            return Utils::buildReturnSuccessStatement(Product::create($request->all()));
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(Product::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required',
                'nome' => 'required',
                'sale_price' => 'required',
            ]);

            $product = Product::find($id);
            return Utils::buildReturnSuccessStatement($product->update($request->all()));
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(Product::destroy($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
