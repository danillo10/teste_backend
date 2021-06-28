<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $fillable = 
    [  
        'pessoa',
        'nome_fantasia',
        'razao_social',
        'cpf_cnpj',
        'email',
        'responsavel',
        'nome_contato',
        'telefone_contato',
        'celular_contato',
        'registro_creci',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'ponto_referencia',
        'bairo',
        'estado',
        'cidade'
    ];

}
