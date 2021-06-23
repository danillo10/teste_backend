<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\Utils;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        try {
            return Utils::buildReturnSuccessStatement(Item::all());
        } catch (\Exception $exception) {
            return Utils::buildReturnErrorStatement($exception->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(Item::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function store(Request $request) {        
        try {
            $request->validate([
                'name' => 'required',
                'stock' => 'required',
                'itemAccount' => 'required'
            ]);
            return Utils::buildReturnSuccessStatement(Item::create($request->all()));
        } catch(\Exception $exception) {
            return Utils::buildReturnErrorStatement($exception->getMessage());   
        }
    }

    public function update(Request $request, $id) {
        $items = Item::find($id);
        $items->update($request->all());
        return Utils::buildReturnSuccessStatement($items);
    }

    public function destroy($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(item::destroy($id));
        } catch (\Exception $exception) {
            return Utils::buildReturnErrorStatement($exception->getMessage());
        }
    }
}
