<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returned_items', function (Blueprint $table) {
            $table->increments('ret_item_id');
            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade');
            $table->integer('bill_id')->unsigned();
            $table->foreign('bill_id')->references('bill_id')->on('bills')->onDelete('cascade');
            $table->float('returned_amount')->default('0')->unsigned();
            $table->integer('curr_id')->unsigned();
            $table->foreign('curr_id')->references('curr_id')->on('currencies')->onDelete('cascade');
            $table->text('description');
            $table->softDeletes();
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
        Schema::dropIfExists('returned_items');
    }
}
