<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\TypeUser;
use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use App\Models\AdministrativeTask;
use App\Models\DocumentsAdministrative;
use App\Models\RouterS3;

class AdministrativeTaskController extends Controller
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
            return Utils::buildReturnSuccessStatement(AdministrativeTask::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(AdministrativeTask::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'status' => 'required',
                'tag' => 'required',
            ]);

            $administrativeTask = AdministrativeTask::create($request->all());

            $fileErro = array();

            if ($request->hasFile('documents_administratives')) {
                $fileErro = array_merge($fileErro, Utils::UploadFilesToS3($administrativeTask, $request->documents_administratives, RouterS3::ADMINISTRATIVES_DOCUMENTS));
            };

            return Utils::buildReturnSuccessStatementUpload($administrativeTask, $fileErro);
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

            $administrativeTask = AdministrativeTask::find($id);
            $administrativeTask->update($request->all());

            $fileErro = array();

            if ($request->documents_administratives_destroy) {
                $fileErro = array_merge($fileErro, Utils::destroyFilesToS3($administrativeTask, $request->documents_administratives_destroy, RouterS3::ADMINISTRATIVES_DOCUMENTS));
            };

            if ($request->hasFile('documents_administratives')) {
                $fileErro = array_merge($fileErro, Utils::uploadFilesToS3($administrativeTask, $request->documents_administratives, RouterS3::ADMINISTRATIVES_DOCUMENTS));
            };

            return Utils::buildReturnSuccessStatementUpload($administrativeTask, $fileErro);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(AdministrativeTask::destroy($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
