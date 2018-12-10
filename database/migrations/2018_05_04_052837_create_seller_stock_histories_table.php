<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerStockHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_stock_histories', function (Blueprint $table) {
            $table->increments('ssh_id');
            $table->integer('ss_id')->unsigned();
            $table->foreign('ss_id')->references('ss_id')->on('seller_stocks')->onDelete('cascade');
            $table->integer('prev_available')->unsigned();
            $table->integer('prev_total_bought')->unsigned();
            $table->integer('prev_total_sold')->unsigned();
            $table->integer('available')->unsigned();
            $table->integer('total_bought')->unsigned();
            $table->integer('total_sold')->unsigned();
            $table->integer('spsd_id')->unsigned()->nullable();
            $table->foreign('spsd_id')->references('spsd_id')->on('s_p_sub_divisions')->onDelete('cascade');
            $table->float('bought_unit_price')->nullable();
            $table->float('sold_unit_price')->nullable();
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
        Schema::dropIfExists('seller_stock_histories');
    }
}
