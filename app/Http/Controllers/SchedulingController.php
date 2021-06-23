<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use App\Models\Scheduling;
use App\Models\TypeUser;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SchedulingController extends Controller
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
            return Utils::buildReturnSuccessStatement(Scheduling::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(Scheduling::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'start_date' => 'required',
                'end_date' => 'required',
                'action' => 'required',
            ]);

            $scheduling = Scheduling::create($request->all());

            return Utils::buildReturnSuccessStatement($scheduling);
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
                'start_date' => 'required',
                'end_date' => 'required',
                'action' => 'required',
            ]);

            $scheduling = Scheduling::find($id);
            $scheduling->update($request->all());

            return Utils::buildReturnSuccessStatement($scheduling);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(Scheduling::destroy($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
