<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingReceipt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_receipt', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->unsignedBigInteger('plan_account_id')->unsigned();
            $table->unsignedBigInteger('realty_id')->unsigned();
            $table->date('issue_date');
            $table->date('entry_date');
            $table->date('due_date');
            $table->date('retirement_date');
            $table->float('total_price',25,2)->nullable();

            $table->foreign('realty_id')->references('id')->on('realty');
            $table->foreign('plan_account_id')->references('id')->on('plan_account');
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
        Schema::dropIfExists('incoming_receipt');
    }
}
