<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImovelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imovels', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->bigInteger('indice_cadastral')->unique();
            $table->float('iptu',25,2);
            $table->float('preco_banco',25,2);
            $table->float('preco',25,2);
            $table->float('preco_condominio',25,2)->nullable();
            $table->string('cep');
            $table->string('logradouro');
            $table->integer('numero');
            $table->string('complemento')->nullable();
            $table->string('ponto_referencia')->nullable();
            $table->string('bairro');
            $table->string('estado',2);
            $table->string('cidade');
            $table->integer('qtd_quarto');
            $table->integer('qtd_suite');
            $table->integer('qtd_banheiro');
            $table->integer('qtd_vagas');
            $table->integer('qtd_pavimento');
            $table->string('tipo');
            $table->string('estado_imovel');
            $table->string('iluminacao');
            $table->string('chave');
            $table->string('acabamento');
            $table->float('area_interna',15,4);
            $table->float('area_externa',15,4);
            $table->float('area_privativa',15,4);
            $table->string('ponto_positivo')->nullable();
            $table->string('ponto_negativo')->nullable();
            $table->float('comissao',3,2)->nullable();
            $table->string('flexibilidade_negociacao')->nullable();
            $table->string('descricao_acabamento')->nullable();
            $table->string('caracteristica_imovel')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imovels');
    }
}
