<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealtorBankAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realtor_bank_account', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('realtor_id')->unsigned();
            $table->unsignedBigInteger('bank_account_id')->unsigned();

            $table->foreign('realtor_id')->references('id')->on('realtor')->onDelete('cascade');
            $table->foreign('bank_account_id')->references('id')->on('bank_account');
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
        Schema::dropIfExists('realtor_bank_account');
    }
}
