<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'nome',
        'indice_cadastral',
        'iptu',
        'preco_banco',
        'preco',
        'preco_condominio',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'ponto_referencia',
        'bairro',
        'estado',
        'cidade',
        'qtd_quarto',
        'qtd_suite',
        'qtd_banheiro',
        'qtd_vagas',
        'qtd_pavimento',
        'tipo',
        'estado_imovel',
        'iluminacao',
        'chave',
        'acabamento',
        'area_interna',
        'area_externa',
        'area_privativa',
        'ponto_positivo',
        'ponto_negativo',
        'comissao',
        'flexibilidade_negociacao',
        'descricao_acabamento',
        'caracteristica_imovel',
        'foto'
    ];
}
