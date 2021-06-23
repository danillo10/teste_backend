<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_account', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bank_id')->unsigned();
            $table->enum('type_account', ['CC', 'CP']);
            $table->bigInteger('cpf_cnpj');
            $table->integer('agency');
            $table->integer('account');
            $table->float('balance',20,2);

            $table->foreign('bank_id')->references('id')->on('bank');
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
        Schema::dropIfExists('bank_account');
    }
}
