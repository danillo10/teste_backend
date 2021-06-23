<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
use App\Models\TypeUser;
use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use App\Http\Controllers\BankAccountController;
use App\Models\Address;
use App\Models\BankAccount;
use App\Models\RealEstateBranch;
use App\Models\RealEstateBankAccount;
use App\Models\RouterS3;
use Illuminate\Http\Request;

class RealEstateBranchController extends Controller
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
            return Utils::buildReturnSuccessStatement(RealEstateBranch::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(RealEstateBranch::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'social_reason' => 'required|unique:real_estate_branches,social_reason|max:191',
                'real_estate_agencies_id' => 'required',
                'cnpj' => 'required|unique:real_estate_agencies,cnpj|unique:real_estate_branches,cnpj|digits:14',
                'email' => 'required|email:rfc,dns|unique:real_estate_branches,email',
                'contact_name' => 'required|max:191',
                'creci_data' => 'file',
                'bank_id' => 'unique:bank_table,id',
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
            $realEstateBranch = RealEstateBranch::create(array_merge($request->all(), $adress->toArray(), ['is_agency' => false]));

            $fileErro = [];

            if ($request->hasFile('creci_data'))
                $fileErro = array_merge($fileErro, Utils::UploadFilesToS3($realEstateBranch, $request->creci_data, RouterS3::REALESTATE_CRECI));

            if ($request->has('bank_account'))
                Utils::createBankForClass($request->get('bank_account'),BankAccount::RealEstateBankAccount, $realEstateBranch['id']);
                
            return Utils::buildReturnSuccessStatementUpload($realEstateBranch, $fileErro);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        }
        catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'social_reason' => 'required|unique:real_estate_branches,social_reason|max:191',
                'cnpj' => 'required|unique:real_estate_agencies,cnpj|digits:14',
                'email' => 'required|email:rfc,dns',
                'contact_name' => 'required|max:191',
                'creci_data' => 'file',
                'bank_id' => 'unique:bank_table,id',
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
            $realEstateBranch = RealEstateBranch::find($id);
            $realEstateBranch->update(array_merge($request->except(['creci_data']), $adress->toArray()));

            $fileErro = [];

            if ($request->hasFile('creci_data')) {
                $fileErro = array_merge($fileErro, Utils::destroyFilesToS3($realEstateBranch, $realEstateBranch->creci_data, RouterS3::PARTNER_CRECI));
                $fileErro = array_merge($fileErro, Utils::uploadFilesToS3($realEstateBranch, $request->realty_media, RouterS3::PARTNER_CRECI));
            };

            if ($request->has('bank_account'))
                Utils::createBankForClass($request->get('bank_account'),BankAccount::RealEstateBankAccount, $realEstateBranch['id']);
 
            return Utils::buildReturnSuccessStatementUpload($realEstateBranch, $fileErro);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        }
        catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(RealEstateBranch::destroy($id));
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) 
                return Utils::buildReturnErrorStatement('2020 - Esse objeto possui relacionamentos existentes');
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
