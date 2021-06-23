<?php

namespace App\Http\Controllers;

use App\Models\RealtyMedia;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\TypeUser;
use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use App\Models\Realty;
use App\Models\RouterS3;

class RealtyMediaController extends Controller
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
            return Utils::buildReturnSuccessStatement(RealtyMedia::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(RealtyMedia::find($id));
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
                $fileErro = array_merge($fileErro, Utils::UploadFilesToS3($request->all(), $request->realty_media, RouterS3::REALTY_MEDIA));

            return Utils::buildReturnSuccessStatementUpload(RealtyMedia::where('realty_id', $request->realty_id)->orderBy('directory')->get(), $fileErro);
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

            $realtyMedia = RealtyMedia::find($id);
            $realtyMedia->update($request->all());

            $fileErro = [];

            if ($request->hasFile('realty_media'))
                $fileErro = array_merge($fileErro, Utils::destroyFilesToS3(null, $realtyMedia, RouterS3::REALTY_MEDIA));

            return Utils::buildReturnSuccessStatementUpload(RealtyMedia::where('realty_id', $id)->orderBy('directory')->get(), $fileErro);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(RealtyMedia::destroy($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }    
    }
}
