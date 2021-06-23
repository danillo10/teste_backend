<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owner', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['Ativo', 'Inativo']);
            $table->enum('person', ['Fisica', 'Juridica']);
            $table->string('name_social_reason');
            $table->bigInteger('cpf_cnpj')->unique();
            $table->string('email')->unique();
            $table->string('contact_name');
            $table->bigInteger('contact_phone');
            $table->bigInteger('contact_cell');
            $table->integer('zip_code');
            $table->string('address');
            $table->integer('address_number');
            $table->string('complement');
            $table->string('reference_point');
            $table->unsignedBigInteger('neighborhood_id')->unsigned();
            $table->unsignedBigInteger('city_id')->unsigned();
            $table->unsignedBigInteger('state_id')->unsigned();
            $table->unsignedBigInteger('customer_capture_id')->unsigned()->nullable();

            $table->foreign('neighborhood_id')->references('id')->on('neighborhood');
            $table->foreign('city_id')->references('id')->on('city');
            $table->foreign('state_id')->references('id')->on('state');
            $table->foreign('customer_capture_id')->references('id')->on('customer_capture');
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
        Schema::dropIfExists('owner');
    }
}
