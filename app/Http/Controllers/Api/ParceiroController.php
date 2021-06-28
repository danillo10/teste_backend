<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\TypeUser;
use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use App\Models\Parceiro;
use App\Models\RouterS3;

class ParceiroController extends Controller
{
    private $types = [
        TypeUser::ADMIN
    ];

    public function __construct()
    {
        $this->middleware(Util::buildRoles($this->types));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return Utils::buildReturnSuccessStatement(Parceiro::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'status' => 'required',
                'pessoa' => 'required',
                'razao_social' => 'required|max:191',
                'cpfcnpj' => 'required|unique:providers,cpf_cnpj',
                'email' => 'required|email:rfc,dns|unique:providers,email',
                'nome_contato' => 'required',
                'telefone_contato' => 'numeric',
                'celular_contato' => 'numeric',
                'cep' => 'required|numeric|digits:8',
                'logradouro' => 'required',
                'numero' => 'required|numeric',
                'bairro' => 'required',
                'cidade' => 'required',
                'estado' => 'required'
            ]);

            $parceiro = Parceiro::create($request->all());

            return Utils::buildReturnSuccessStatement($parceiro);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(Parceiro::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required',
                'pessoa' => 'required',
                'razao_social' => 'required|max:191',
                'cpfcnpj' => 'required|unique:providers,cpf_cnpj',
                'email' => 'required|email:rfc,dns|unique:providers,email',
                'nome_contato' => 'required',
                'telefone_contato' => 'numeric',
                'celular_contato' => 'numeric',
                'cep' => 'required|numeric|digits:8',
                'logradouro' => 'required',
                'numero' => 'required|numeric',
                'bairro' => 'required',
                'cidade' => 'required',
                'estado' => 'required'
            ]);

            $parceiro = Parceiro::find($id);
            $partner->update($request->all());

            return Utils::buildReturnSuccessStatement($parceiro);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(Parceiro::destroy($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
