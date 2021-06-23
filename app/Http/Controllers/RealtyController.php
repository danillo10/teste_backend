<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\TypeUser;
use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use App\Models\Product;
use App\Models\Realty;
use App\Models\RealtyEvaluations;
use App\Models\RealtyMedia;
use App\Models\RouterS3;

class RealtyController extends Controller
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
            return Utils::buildReturnSuccessStatement(Realty::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(Realty::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'real_estate_branches_id' => 'required',
                'owner_id' => 'required',
                'realty_type_id' => 'required',
                'realty_status_id' => 'required',
                'cadastral_index' => 'required',
                'qty_bedrooms' => 'required',
                'qty_bathroom' => 'required',
                'qty_garage' => 'required',
                'qty_suite' => 'required',
                'qty_pavement' => 'required',
                'commission' => 'required',
                'total_area' => 'required',
                'zip_code' => 'required|numeric|digits:8',
                'address' => 'required',
                'address_number' => 'required|numeric',
                'neighborhood' => 'required',
                'city' => 'required',
                'contact_phone' => 'required|numeric',
                'contact_cell' => 'numeric',
                'iptu_price' => 'required'
            ]);

            $adress = AddressController::getAddress($request);
            $realty = Realty::create(array_merge($request->all(), $adress->toArray(), ['status' => 1]));
            Product::create(array_merge($request->all(), ['description' => 'Imovel', 'nome' =>$realty->id . ' - ' . $realty->address . ', ' . $realty->address_number, 'realty_id' => $realty->id, 'sale_price' => $realty->price, 'status' => 1, 'stock' => 1]));
            RealtyEvaluations::create(array_merge($request->all(), ['realty_id' => $realty->id]));

            $fileErro = [];
            if ($request->hasFile('realty_media'))
                $fileErro = array_merge($fileErro, Utils::UploadFilesToS3($realty, $request->realty_media, RouterS3::REALTY_MEDIA));

            if ($request->hasFile('realty_attachment'))
                $fileErro = array_merge($fileErro, Utils::UploadFilesToS3($realty, $request->realty_attachment, RouterS3::REALTY_ATTACHMENT));

            return Utils::buildReturnSuccessStatementArray($realty, "FileErro", $fileErro);
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
                'real_estate_branches_id' => 'required',
                'owner_id' => 'required',
                'realty_type_id' => 'required',
                'realty_status_id' => 'required',
                'cadastral_index' => 'required',
                'qty_bedrooms' => 'required',
                'qty_bathroom' => 'required',
                'qty_garage' => 'required',
                'qty_suite' => 'required',
                'qty_pavement' => 'required',
                'commission' => 'required',
                'total_area' => 'required',
                'zip_code' => 'required|numeric|digits:8',
                'address' => 'required',
                'address_number' => 'required|numeric',
                'neighborhood' => 'required',
                'city' => 'required',
                'contact_phone' => 'required|numeric',
                'contact_cell' => 'numeric',
                'iptu_price' => 'required'
            ]);

            $adress = AddressController::getAddress($request);
            $realty = Realty::find($id);
            $realty->update(array_merge($request->all(), $adress->toArray()));
            $product = Product::where('realty_id', $id);
            $product->update(array_merge(['description' => 'Imovel', 'nome' => $realty->id . ' - ' . $realty->address . ', ' . $realty->address_number, 'realty_id' => $realty->id, 'sale_price' => ($realty->price == NULL ? $realty->rent_price : $realty->price), 'status' => $realty->status]));
            $realtyEvaluations = $realty->realtyEvaluations()->where('realty_id', $realty['id'])->first();
            $realtyEvaluations->update($request->all());

            $fileErro = [];

            if ($request->realty_media_destroy)
                $fileErro = array_merge($fileErro, Utils::destroyFilesToS3($realty, $request->realty_media_destroy, RouterS3::REALTY_MEDIA));

            if ($request->realty_attachment_destroy)
                $fileErro = array_merge($fileErro, Utils::destroyFilesToS3($realty, $request->realty_attachment_destroy, RouterS3::REALTY_ATTACHMENT));

            if ($request->hasFile('realty_media'))
                $fileErro = array_merge($fileErro, Utils::uploadFilesToS3($realty, $request->realty_media, RouterS3::REALTY_MEDIA));

            if ($request->hasFile('realty_attachment'))
                $fileErro = array_merge($fileErro, Utils::uploadFilesToS3($realty, $request->realty_attachment, RouterS3::REALTY_ATTACHMENT));

            return Utils::buildReturnSuccessStatement($realty, $fileErro);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $urlDestroy = RouterS3::REALTY_MEDIA . '/' . $id ;
            Utils::destroyFolderToS3($urlDestroy);
            $urlDestroy = RouterS3::REALTY_ATTACHMENT . '/' . $id ;
            Utils::destroyFolderToS3($urlDestroy);
            $product = Product::where('realty_id', $id)->get()->first();
            Product::destroy($product->id);
            return Utils::buildReturnSuccessStatement(Realty::destroy($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
