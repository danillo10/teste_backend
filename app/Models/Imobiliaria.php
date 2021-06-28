<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imobiliaria extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'razao_social',
        'numero_cresci',
        'arquivo_cresci',
        'cnpj',
        'email',
        'is_agency',
        'responsavel',
        'telefone_contato',
        'celular_contato',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'ponto_referencia',
        'bairro',
        'estado',
        'cidade'
    ];
}
