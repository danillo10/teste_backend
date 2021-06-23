<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['Ativo', 'Inativo']);
            $table->string('nome')->unique();
            $table->string('description');
            $table->unsignedBigInteger('realty_id')->unsigned()->nullable();
            $table->unsignedBigInteger('provider_id')->unsigned()->nullable();
            $table->bigInteger('stock');
            $table->float('cost_price',25,2)->nullable();
            $table->float('sale_price',25,2)->nullable();

            $table->foreign('realty_id')->references('id')->on('realty');
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
        Schema::dropIfExists('product');
    }
}
