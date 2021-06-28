<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImobiliariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imobiliarias', function (Blueprint $table) {
            $table->id();
            $table->string('razao_social')->unique();
            $table->string('numero_creci')->nullable();
            $table->string('arquivo_creci')->nullable();
            $table->bigInteger('cnpj')->unique();
            $table->string('email')->unique();
            $table->string('responsavel');
            $table->boolean('is_agency');
            $table->bigInteger('telefone_contato');
            $table->bigInteger('celular_contato')->nullable();
            $table->string('cep');
            $table->string('logradouro');
            $table->integer('numero');
            $table->string('complemento')->nullable();
            $table->string('ponto_referencia')->nullable();
            $table->string('bairro');
            $table->string('estado',2);
            $table->string('cidade');
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
        Schema::dropIfExists('imobiliarias');
    }
}
