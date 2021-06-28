<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeUser;
use App\Models\Imobiliaria;
use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;

class ImobiliariaController extends Controller
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
            return Utils::buildReturnSuccessStatement(Imobiliaria::all());
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
                'razao_social' => 'required|unique:imobiliarias,razao_social|max:191',
                'cnpj' => 'required|unique:imobiliarias,cpf_cnpj|digits:14',
                'email' => 'required|email:rfc,dns|unique:imobiliarias,email',
                'responsavel' => 'required|max:191',
                'creci_data' => 'file',
                'telefone_contato' => 'required|numeric',
                'celular_contato' => 'numeric',
                'cep' => 'required|numeric|digits:8',
                'logradouro' => 'required',
                'numero' => 'required|numeric',
                'bairro' => 'required',
                'cidade' => 'required',
                'estado' => 'required'
            ]);

            $imobiliaria = Imobiliaria::create($request->all());

            $fileErro = [];

            if ($request->hasFile('creci_data'))
                $fileErro = array_merge($fileErro, Utils::UploadFilesToS3($imobiliaria, $request->creci_data, RouterS3::REALESTATE_CRECI));
                
            return Utils::buildReturnSuccessStatementUpload($imobiliaria, $fileErro);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        }
        catch (\Exception $e) {
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
            $imobiliaria = Imobiliaria::find($id);
            return Utils::buildReturnSuccessStatement($imobiliaria);
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
                'razao_social' => 'required|unique:imobiliarias,razao_social|max:191',
                'cnpj' => 'required|unique:imobiliarias,cpf_cnpj|digits:14',
                'email' => 'required|email:rfc,dns|unique:imobiliarias,email',
                'responsavel' => 'required|max:191',
                'arquivo_creci' => 'file',
                'telefone_contato' => 'required|numeric',
                'celular_contato' => 'numeric',
                'cep' => 'required|numeric|digits:8',
                'logradouro' => 'required',
                'numero' => 'required|numeric',
                'bairro' => 'required',
                'cidade' => 'required',
                'estado' => 'required'
            ]);
            $imobiliaria = Imobiliaria::find($id);
            $imobiliaria->update($request->except(['creci_data']));

            $fileErro = [];

            if ($request->hasFile('creci_data')) {
                $fileErro = array_merge($fileErro, Utils::destroyFilesToS3($imobiliaria, $realEstateBranch->creci_data, RouterS3::PARTNER_CRECI));
                $fileErro = array_merge($fileErro, Utils::uploadFilesToS3($imobiliaria, $request->realty_media, RouterS3::PARTNER_CRECI));
            };

            return Utils::buildReturnSuccessStatementUpload($imobiliaria, $fileErro);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        }
        catch (\Exception $e) {
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
            return Utils::buildReturnSuccessStatement(Imobiliaria::destroy($id));
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) 
                return Utils::buildReturnErrorStatement('2020 - Esse objeto possui relacionamentos existentes');
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
