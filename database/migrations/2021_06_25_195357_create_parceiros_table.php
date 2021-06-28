<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParceirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parceiros', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['Ativo', 'Inativo']);
            $table->enum('pessoa', ['Fisica', 'Juridica']);
            $table->string('nome_fantasia')->nullable();
            $table->string('razao_social')->nullable();
            $table->string('cpfcnpj')->unique();
            $table->string('email')->unique();
            $table->float('faturamento',15,4);
            $table->string('origem')->nullable();
            $table->string('nome_contato');
            $table->string('telefone_contato');
            $table->string('celular_contato');
            $table->string('registro_creci');
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
        Schema::dropIfExists('parceiros');
    }
}
