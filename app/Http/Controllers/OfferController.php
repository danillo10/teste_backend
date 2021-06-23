<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\Utils;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    
    public function index()
    {
        try {
            return Utils::buildReturnSuccessStatement(Offer::all());
        } catch (\Exception $exception) {
            return Utils::buildReturnErrorStatement($exception->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'isAvailableToOffer' => 'required',
                'realty_id' => 'required'
            ]);
            
            return Utils::buildReturnSuccessStatement(Offer::create($request->all()));
        } catch(\Exception $exception) {
            return Utils::buildReturnErrorStatement($exception->getMessage());   
        }
    }

    public function update(Request $request, $id) {
        $offer = Offer::find($id);
        $offer->update($request->all());
        return Utils::buildReturnSuccessStatement($offer);
    }

    public function destroy($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(Offer::destroy($id));
        } catch (\Exception $exception) {
            return Utils::buildReturnErrorStatement($exception->getMessage());
        }
    }
}
