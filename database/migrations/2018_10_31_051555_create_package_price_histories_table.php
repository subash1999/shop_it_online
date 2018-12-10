<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagePriceHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_price_histories', function (Blueprint $table) {
            $table->increments('pph_id');
            $table->integer('pac_id')->unsigned()->nullable();
            $table->foreign('pac_id')->references('pac_id')->on('packages')->onDelete('cascade'); 
            $table->float('prev_amount');
            $table->float('pac_amount');
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
        Schema::dropIfExists('package_price_histories');
    }
}
