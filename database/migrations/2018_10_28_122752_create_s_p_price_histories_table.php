<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSPPriceHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_p_price_histories', function (Blueprint $table) {
            $table->increments('s_p_price_history_id');
            $table->integer('sp_id')->unsigned()->nullable();
            $table->foreign('sp_id')->references('sp_id')->on('seller_products')->onDelete('cascade');
            $table->float('price')->nullable();
            $table->integer('curr_id')->unsigned()->nullable();
            $table->foreign('curr_id')->references('curr_id')->on('currencies')->onDelete('cascade');
            $table->dateTime('from_date')->nullable();
            $table->dateTime('to_date')->nullable();
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
        Schema::dropIfExists('s_p_price_histories');
    }
}
