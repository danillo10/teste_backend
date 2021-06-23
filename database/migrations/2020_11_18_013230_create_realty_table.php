<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealtyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realty', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('real_estate_branches_id')->unsigned();
            $table->unsignedBigInteger('owner_id')->unsigned();
            $table->boolean('available')->nullable();
            $table->unsignedBigInteger('realty_type_id')->unsigned()->nullable();
            $table->unsignedBigInteger('realty_status_id')->unsigned()->nullable();
            $table->enum('key_possession', ['Porteiro', 'Imobiliaria', 'Proprietario', 'Inquilino'])->nullable();
            $table->string('key_possession_name')->nullable();
            $table->bigInteger('key_possession_contact')->nullable();
            $table->enum('type_contract', ['Contrato X', 'Contrato Y'])->nullable();
            $table->bigInteger('cadastral_index')->unique();
            $table->bigInteger('qty_bedrooms')->nullable();
            $table->bigInteger('qty_garage')->nullable();
            $table->bigInteger('qty_bathroom')->nullable();
            $table->bigInteger('qty_suite')->nullable();
            $table->bigInteger('qty_pavement')->nullable();
            $table->boolean('living_room')->nullable();
            $table->boolean('kitchen')->nullable();
            $table->boolean('pool')->nullable();
            $table->boolean('recreation_area')->nullable();
            $table->boolean('barbecue_grill')->nullable();
            $table->boolean('sports_court')->nullable();
            $table->boolean('sports_field')->nullable();
            $table->boolean('sala_copa')->nullable();
            $table->boolean('tv_room')->nullable();
            $table->boolean('balcony')->nullable();
            $table->boolean('gourmet_balcony')->nullable();
            $table->enum('sunny_period', ['Manha', 'Tarde'])->nullable();
            $table->string('positive_points')->nullable();
            $table->string('negative_points')->nullable();
            $table->string('flexibility_trading')->nullable();
            $table->boolean('registered');
            $table->float('commission',3,2)->nullable();
            $table->float('total_area',15,4)->nullable();
            $table->date('delivery_forecast')->nullable();
            $table->integer('zip_code');
            $table->string('address');
            $table->integer('address_number');
            $table->string('complement')->nullable();
            $table->string('reference_point')->nullable();
            $table->unsignedBigInteger('neighborhood_id')->unsigned();
            $table->unsignedBigInteger('city_id')->unsigned();
            $table->unsignedBigInteger('state_id')->unsigned();
            $table->unsignedBigInteger('customer_capture_id')->unsigned()->nullable();
            $table->string('contact_name');
            $table->bigInteger('contact_phone')->nullable();
            $table->bigInteger('contact_cell');
            $table->float('price',25,2)->nullable();
            $table->float('rent_price',25,2)->nullable();
            $table->float('bank_appraisal_price',25,2)->nullable();
            $table->float('condo_price',25,2)->nullable();
            $table->float('iptu_price',25,2);
            $table->float('max_price_financed',25,2)->nullable();
            $table->integer('max_qty_parcels')->nullable();      
            
            $table->foreign('owner_id')->references('id')->on('owner')->onDelete('cascade');
            $table->foreign('neighborhood_id')->references('id')->on('neighborhood');
            $table->foreign('city_id')->references('id')->on('city');
            $table->foreign('state_id')->references('id')->on('state');
            $table->foreign('customer_capture_id')->references('id')->on('customer_capture');
            $table->foreign('real_estate_branches_id')->references('id')->on('real_estate_branches');
            $table->foreign('realty_status_id')->references('id')->on('realty_status');
            $table->foreign('realty_type_id')->references('id')->on('realty_type');
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
        Schema::dropIfExists('realty');
    }
}
