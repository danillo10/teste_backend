<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingReceiptItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_receipt_item', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->unsignedBigInteger('product_id')->unsigned();
            $table->unsignedBigInteger('incoming_receipt_id')->unsigned();
            $table->date('issue_date');
            $table->date('entry_date');
            $table->float('unit_price',25,2)->nullable();
            $table->float('total_price',25,2)->nullable();

            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('incoming_receipt_id')->references('id')->on('incoming_receipt')->onDelete('cascade');;
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
        Schema::dropIfExists('incoming_receipt_item');
    }
}
