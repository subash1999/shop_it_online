<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferPriceHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_price_histories', function (Blueprint $table) {
            $table->increments('oph_id');
            $table->float('offer_unit_price');
            $table->integer('offer_id')->unsigned()->nullable();
            $table->foreign('offer_id')->references('offer_id')->on('offers')->onDelete('cascade');
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
        Schema::dropIfExists('offer_price_histories');
    }
}
