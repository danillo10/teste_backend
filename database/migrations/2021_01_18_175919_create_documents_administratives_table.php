<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsAdministrativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_administratives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('administrative_tasks_id')->unsigned();
            $table->string("directory");
            $table->timestamps();
 
            $table->foreign('administrative_tasks_id')->references('id')->on('administrative_tasks');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents_administratives');
    }
}
