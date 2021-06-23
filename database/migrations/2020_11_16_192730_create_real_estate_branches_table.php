<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estate_branches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('real_estate_agencies_id')->unsigned();
            $table->string('social_reason')->unique();
            $table->string('creci_number')->nullable();
            $table->string('creci_data')->nullable();
            $table->bigInteger('cnpj')->unique();
            $table->string('email')->unique();
            $table->string('contact_name')->nullable();
            $table->boolean('is_agency');
            $table->bigInteger('contact_phone');
            $table->bigInteger('contact_cell')->nullable();
            $table->integer('zip_code');
            $table->string('address');
            $table->integer('address_number');
            $table->string('complement')->nullable();
            $table->string('reference_point')->nullable();
            $table->unsignedBigInteger('customer_capture_id')->unsigned()->nullable();
            $table->unsignedBigInteger('neighborhood_id')->unsigned();
            $table->unsignedBigInteger('city_id')->unsigned();
            $table->unsignedBigInteger('state_id')->unsigned();

            $table->foreign('real_estate_agencies_id')->references('id')->on('real_estate_agencies');
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
        Schema::dropIfExists('real_estate_branches');
    }
}
