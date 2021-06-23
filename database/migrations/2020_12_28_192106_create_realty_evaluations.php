<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealtyEvaluations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realty_evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('realty_id')->unsigned();
            $table->float('price_wanted',20,2)->nullable();
            $table->float('price_m2',20,2)->nullable();
            $table->float('price_m2_average',20,2)->nullable();
            $table->float('price_m2_like',20,2)->nullable();
            $table->string('location_details')->nullable();
            $table->boolean('is_new')->default('0');
            $table->enum('electrical_installation', ['Ruim', 'Regular', 'Bom', 'Otimo'])->nullable();
            $table->enum('hydraulic_installation', ['Ruim', 'Regular', 'Bom', 'Otimo'])->nullable();
            $table->enum('painting', ['Ruim', 'Regular', 'Bom', 'Otimo'])->nullable();
            $table->enum('finishing', ['Ruim', 'Regular', 'Bom', 'Otimo'])->nullable();
            $table->enum('liners', ['Ruim', 'Regular', 'Bom', 'Otimo'])->nullable();
            $table->enum('roofs', ['Ruim', 'Regular', 'Bom', 'Otimo'])->nullable();
            $table->enum('glassware', ['Ruim', 'Regular', 'Bom', 'Otimo'])->nullable();
            $table->string('external_noises')->nullable();
            $table->string('safety')->nullable();
            $table->string('note')->nullable();

            $table->foreign('realty_id')->references('id')->on('realty')->onDelete('cascade');;
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
        Schema::dropIfExists('realty_evaluations');
    }
}
