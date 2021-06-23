<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\TypeUser;
use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use App\Http\Controllers\BankAccountController;
use App\Models\BankAccount;
use App\Models\Partner;
use App\Models\PartnerBankAccount;
use App\Models\RouterS3;

class PartnerController extends Controller
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
            return Utils::buildReturnSuccessStatement(Partner::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(Partner::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'status' => 'required',
                'person' => 'required',
                'profile_partner' => 'required',
                'name_social_reason' => 'required|max:191',
                'cpf_cnpj' => 'required|unique:partners,cpf_cnpj',
                'email' => 'required|email:rfc,dns|unique:partners,email',
                'contact_phone' => 'required|numeric',
                'contact_cell' => 'numeric',
                'zip_code' => 'required|numeric|digits:8',
                'address' => 'required',
                'address_number' => 'required|numeric',
                'neighborhood' => 'required',
                'city' => 'required',
                'state' => 'required',
                'creci_data' => 'image|mimes:jpg,jpeg,png'
            ]);

            $partner = Partner::create($request->except(['creci_data']));

            $fileErro = [];
            $newbankAccounts = [];

            if ($request->hasFile('creci_data'))
                $fileErro = array_merge($fileErro, Utils::UploadFilesToS3($partner, $request->creci_data, RouterS3::PARTNER_CRECI));

            if ($request->has('bank_account'))
                $newbankAccounts = Utils::updateBankForClass($request->get('bank_account'), BankAccount::PartnerBankAccount);

            return Utils::buildReturnSuccessStatementArray(array_merge($partner, $newbankAccounts), "FileErro", $fileErro);
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
                'name_social_reason' => 'max:191',
                'email' => 'email:rfc,dns',
                'contact_phone' => 'numeric',
                'contact_cell' => 'numeric',
                'zip_code' => 'numeric|digits:8',
                'address' => 'required',
                'address_number' => 'required|numeric',
                'neighborhood' => 'required',
                'city' => 'required',
                'state' => 'required',
                'creci_data' => 'image|mimes:jpg,jpeg,png'
            ]);

            $partner = Partner::find($id);
            $partner->update($request->except(['creci_data']));

            $fileErro = [];
            $newbankAccounts = [];

            if ($request->hasFile('creci_data')) {
                $fileErro = array_merge($fileErro, Utils::destroyFilesToS3($partner, $partner->creci_data, RouterS3::PARTNER_CRECI));
                $fileErro = array_merge($fileErro, Utils::uploadFilesToS3($partner, $request->realty_media, RouterS3::PARTNER_CRECI));
            };

            if ($request->has('bank_account'))
                $newbankAccounts = Utils::updateBankForClass($request->get('bank_account'),BankAccount::PartnerBankAccount);

            return Utils::buildReturnSuccessStatementArray(array_merge($partner, $newbankAccounts), "FileErro", $fileErro);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $urlDestroy = RouterS3::PARTNER_CRECI . '/' . $id ;
            Utils::destroyFolderToS3($urlDestroy);
            return Utils::buildReturnSuccessStatement(Partner::destroy($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
