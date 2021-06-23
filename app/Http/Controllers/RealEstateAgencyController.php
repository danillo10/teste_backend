<?php

namespace App\Http\Controllers;

use App\Models\RealEstateAgency;
use App\Models\RealEstateBranch;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\TypeUser;
use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Helpers\Utils;
use App\Models\Address;
use App\Models\BankAccount;
use App\Models\RealEstateBankAccount;
use App\Models\RouterS3;

class RealEstateAgencyController extends Controller
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
            return Utils::buildReturnSuccessStatement(RealEstateAgency::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(RealEstateAgency::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'social_reason' => 'required|unique:real_estate_agencies,social_reason|max:191',
                'cnpj' => 'required|unique:real_estate_agencies,cnpj|unique:real_estate_branches,cnpj|digits:14',
                'email' => 'required|email:rfc,dns|unique:real_estate_branches,email',
                'contact_name' => 'required|max:191',
                'creci_data' => 'file',
                'contact_phone' => 'required|numeric',
                'contact_cell' => 'numeric',
                'zip_code' => 'required|numeric|digits:8',
                'address' => 'required',
                'address_number' => 'required|numeric',
                'neighborhood' => 'required',
                'city' => 'required',
                'state' => 'required'
            ]);

            $adress = AddressController::getAddress($request);
            $realEstateAgency = RealEstateAgency::create($request->all());
            $realEstateBranch = RealEstateBranch::create(array_merge($request->all(), $adress->toArray(), ['real_estate_agencies_id' => $realEstateAgency->id, 'is_agency' => true]));

            $fileErro = [];

            if ($request->hasFile('creci_data'))
                $fileErro = array_merge($fileErro, Utils::UploadFilesToS3($realEstateBranch, $request->creci_data, RouterS3::REALESTATE_CRECI));

            if ($request->has('bank_account'))
                Utils::createBankForClass($request->get('bank_account'),BankAccount::RealEstateBankAccount, $realEstateBranch['id']);

            return Utils::buildReturnSuccessStatementArray($realEstateBranch, "FileErro", $fileErro);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            if ($realEstateAgency != null) 
                RealEstateAgency::destroy($realEstateAgency->id);
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'social_reason' => 'required|unique:real_estate_agencies,social_reason|max:191',
                'cnpj' => 'unique:real_estate_agencies,cnpj|max:14|min:14',
            ]);

            $realEstateAgency = RealEstateAgency::find($id);
            $realEstateBranchs = $realEstateAgency->realEstateBranchs()->where('cnpj', $realEstateAgency['cnpj'])->where('is_agency', 1)->first();
            $realEstateAgency->update($request->except(['creci_data']));
            $realEstateBranchs->update($request->except(['creci_data']));

            if ($request->has('bank_account'))
                Utils::updateBankForClass($request->get('bank_account'),BankAccount::RealEstateBankAccount);

            return Utils::buildReturnSuccessStatement($realEstateBranchs);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e){
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(RealEstateAgency::destroy($id));
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) 
                return Utils::buildReturnErrorStatement('2020 - Esse objeto possui relacionamentos existentes');
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
