<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RouterS3;
use Illuminate\Validation\ValidationException;
use App\Models\TypeUser;
use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use App\Models\DocumentsAdministrative;

class DocumentsAdministrativeController extends Controller
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
            return Utils::buildReturnSuccessStatement(DocumentsAdministrative::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(DocumentsAdministrative::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'administrative_tasks_id' => 'required',
            ]);

            $documentsAdministrative = DocumentsAdministrative::create($request->all());

            $fileErro = array();

            if ($request->hasFile('documents_administratives'))
                $fileErro = array_merge($fileErro, Utils::UploadFilesToS3($documentsAdministrative, $request->documents_administratives, RouterS3::ADMINISTRATIVES_DOCUMENTS));

            return Utils::buildReturnSuccessStatement(DocumentsAdministrative::where('administrative_tasks_id', $request->administrative_tasks_id)->orderBy('directory')->get(), $fileErro);
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

            $documentsAdministrative = DocumentsAdministrative::find($id);
            $documentsAdministrative->update($request->all());

            $fileErro = array();

            if ($request->documents_administratives_destroy)
                $fileErro = array_merge($fileErro, Utils::destroyFilesToS3($documentsAdministrative, $request->documents_administratives_destroy, RouterS3::ADMINISTRATIVES_DOCUMENTS));

            if ($request->hasFile('documents_administratives'))
                $fileErro = array_merge($fileErro, Utils::uploadFilesToS3($documentsAdministrative, $request->documents_administratives, RouterS3::ADMINISTRATIVES_DOCUMENTS));

            return Utils::buildReturnSuccessStatement(DocumentsAdministrative::where('administrative_tasks_id', $request->administrative_tasks_id)->orderBy('directory')->get(), $fileErro);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(DocumentsAdministrative::destroy($id));
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
