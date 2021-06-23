<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\TypeUser;
use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use App\Models\RealtyAttachment;
use App\Models\RouterS3;

class RealtyAttachmentController extends Controller
{
    private $types = [
        TypeUser::ADMIN
    ];

    public function __construct()
    {
        $this->middleware(Util::buildRoles($this->types));
    }

    function index()
    {
        try {
            return Utils::buildReturnSuccessStatement(RealtyAttachment::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(RealtyAttachment::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'realty_id' => 'required',
                'realty_media' => 'file'
            ]);

            $fileErro = [];
            if ($request->hasFile('realty_media'))
                $fileErro = array_merge($fileErro, Utils::UploadFilesToS3($request->all(), $request->realty_media, RouterS3::REALTY_ATTACHMENT));

            return Utils::buildReturnSuccessStatementUpload(RealtyAttachment::where('realty_id', $request->realty_id)->orderBy('directory')->get(), $fileErro);
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
            ]);

            $realtyAttachment = RealtyAttachment::find($id);
            $realtyAttachment->update($request->all());

            $fileErro = [];

            if ($request->hasFile('realty_media'))
                $fileErro = array_merge($fileErro, Utils::destroyFilesToS3(null, $realtyAttachment, RouterS3::REALTY_ATTACHMENT));

            return Utils::buildReturnSuccessStatementUpload(RealtyAttachment::where('realty_id', $id)->orderBy('directory')->get(), $fileErro);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(RealtyAttachment::destroy($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }    
    }
}
