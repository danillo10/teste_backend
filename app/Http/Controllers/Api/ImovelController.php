<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\TypeUser;
use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use App\Models\Imovel;
use App\Models\RouterS3;

class ImovelController extends Controller
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
            return Utils::buildReturnSuccessStatement(Imovel::all());
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
                'nome' => 'required',
                'indice_cadastral' => 'required',
                'iptu' => 'required',
                'preco_banco' => 'required',
                'preco' => 'required',
                'cep' => 'required|numeric|digits:8',
                'logradouro' => 'required',
                'numero' => 'required|numeric',
                'bairro' => 'required',
                'cidade' => 'required',
                'qtd_quarto' => 'required',
                'qtd_suite' => 'required',
                'qtd_banheiro' => 'required',
                'qtd_vagas' => 'required',
                'qtd_pavimento' => 'required',
                'tipo' => 'required',
                'estado_imovel' => 'required',
                'iluminacao' => 'required',
                'chave' => 'required',
                'acabamento' => 'required',
                'area_interna' => 'required|numeric',
                'area_externa' => 'required|numeric',
                'area_privativa' => 'required|numeric'
            ]);

            $imovel = Imovel::create($request->all());

            $fileErro = [];
            if ($request->hasFile('realty_media'))
                $fileErro = array_merge($fileErro, Utils::UploadFilesToS3($imovel, $request->realty_media, RouterS3::REALTY_MEDIA));

            if ($request->hasFile('realty_attachment'))
                $fileErro = array_merge($fileErro, Utils::UploadFilesToS3($imovel, $request->realty_attachment, RouterS3::REALTY_ATTACHMENT));

            return Utils::buildReturnSuccessStatementArray($realty, "FileErro", $fileErro);
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
            return Utils::buildReturnSuccessStatement(Imovel::find($id));
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
                'nome' => 'required',
                'indice_cadastral' => 'required',
                'iptu' => 'required',
                'preco_banco' => 'required',
                'preco' => 'required',
                'cep' => 'required|numeric|digits:8',
                'logradouro' => 'required',
                'numero' => 'required|numeric',
                'bairro' => 'required',
                'cidade' => 'required',
                'qtd_quarto' => 'required',
                'qtd_suite' => 'required',
                'qtd_banheiro' => 'required',
                'qtd_vagas' => 'required',
                'qtd_pavimento' => 'required',
                'tipo' => 'required',
                'estado_imovel' => 'required',
                'iluminacao' => 'required',
                'chave' => 'required',
                'acabamento' => 'required',
                'area_interna' => 'required|numeric',
                'area_externa' => 'required|numeric',
                'area_privativa' => 'required|numeric'
            ]);

            $imovel = Imovel::find($id);
            $imovel->update($request->all());

            $fileErro = [];

            if ($request->realty_media_destroy)
                $fileErro = array_merge($fileErro, Utils::destroyFilesToS3($imovel, $request->realty_media_destroy, RouterS3::REALTY_MEDIA));

            if ($request->realty_attachment_destroy)
                $fileErro = array_merge($fileErro, Utils::destroyFilesToS3($imovel, $request->realty_attachment_destroy, RouterS3::REALTY_ATTACHMENT));

            if ($request->hasFile('realty_media'))
                $fileErro = array_merge($fileErro, Utils::uploadFilesToS3($imovel, $request->realty_media, RouterS3::REALTY_MEDIA));

            if ($request->hasFile('realty_attachment'))
                $fileErro = array_merge($fileErro, Utils::uploadFilesToS3($imovel, $request->realty_attachment, RouterS3::REALTY_ATTACHMENT));

            return Utils::buildReturnSuccessStatement($realty, $fileErro);
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
            $urlDestroy = RouterS3::REALTY_MEDIA . '/' . $id ;
            Utils::destroyFolderToS3($urlDestroy);
            $urlDestroy = RouterS3::REALTY_ATTACHMENT . '/' . $id ;
            Utils::destroyFolderToS3($urlDestroy);
            
            return Utils::buildReturnSuccessStatement(Imovel::destroy($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
