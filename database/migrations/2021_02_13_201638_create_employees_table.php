<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['Ativo', 'Inativo']);
            $table->enum('type_employee', ['CLT', 'MEI']);
            $table->unsignedBigInteger('office_id')->unsigned(); 
            $table->float('salary_gross',25,2)->nullable();
            $table->string('name');
            $table->bigInteger('cpf')->unique();
            $table->string('email')->unique();
            $table->date('date_admission')->nullable();
            $table->date('date_resignation')->nullable();
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

            $table->foreign('office_id')->references('id')->on('office');
            $table->foreign('neighborhood_id')->references('id')->on('neighborhood');
            $table->foreign('city_id')->references('id')->on('city');
            $table->foreign('state_id')->references('id')->on('state');
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
        Schema::dropIfExists('employees');
    }
}
