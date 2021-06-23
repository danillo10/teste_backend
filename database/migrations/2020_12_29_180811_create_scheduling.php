<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduling extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduling', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['Ativo', 'Inativo']);
            $table->unsignedBigInteger('realty_id')->unsigned()->nullable();
            $table->unsignedBigInteger('owner_id')->unsigned()->nullable();
            $table->unsignedBigInteger('client_id')->unsigned()->nullable();
            $table->unsignedBigInteger('partner_id')->unsigned()->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('action',['Visita Tecnica', 'Vistoria'])->nullable();
            $table->string('color');
            $table->string('address')->nullable();
            $table->string('note')->nullable();

            $table->foreign('realty_id')->references('id')->on('realty');
            $table->foreign('owner_id')->references('id')->on('owner');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('partner_id')->references('id')->on('partners');

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
        Schema::dropIfExists('scheduling');
    }
}
