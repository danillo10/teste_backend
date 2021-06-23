<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstateBankAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estate_bank_account', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('real_estate_branches_id')->unsigned();
            $table->unsignedBigInteger('bank_account_id')->unsigned();

            $table->foreign('real_estate_branches_id')->references('id')->on('real_estate_branches');
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
        Schema::dropIfExists('real_estate_bank_account');
    }
}
