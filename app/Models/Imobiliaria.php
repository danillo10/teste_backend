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
        'numero_creci',
        'arquivo_creci',
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
        'cidade',
        'cpfcnpj_banco',
        'banco_id',
        'tipo_conta',
        'agencia',
        'conta'
    ];
}
