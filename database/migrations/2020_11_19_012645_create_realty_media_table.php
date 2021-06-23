<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealtyMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realty_media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('realty_id')->unsigned();
            $table->string('directory');
            $table->timestamps();

            $table->foreign('realty_id')->references('id')->on('realty')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('realty_media');
    }
}
