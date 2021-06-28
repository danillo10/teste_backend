<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = 
    [  
        'status',
        'pessoa',
        'nome_fantasia',
        'razao_social',
        'cpf_cnpj',
        'email',
        'faturamento',
        'origem',
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
