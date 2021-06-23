<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealtyOwner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realty_owner', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id')->unsigned();
            $table->unsignedBigInteger('realty_id')->unsigned();

            $table->foreign('owner_id')->references('id')->on('owner')->onDelete('cascade');
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
        Schema::dropIfExists('realty_owner');
    }
}
