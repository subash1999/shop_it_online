<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSPShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_p_shippings', function (Blueprint $table) {
            $table->increments('sp_ship_id');
            $table->integer('sp_id')->unsigned();
            $table->foreign('sp_id')->references('sp_id')->on('seller_products')->onDelete('cascade');
            $table->float('ship_charge')->unsigned()->default('0');
            $table->integer('curr_id')->unsigned();
            $table->foreign('curr_id')->references('curr_id')->on('currencies')->onDelete('cascade');
            $table->float('min_days')->unsigned()->default('0');
            $table->float('max_days')->unsigned()->nullable();
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
        Schema::dropIfExists('s_p_shippings');
    }
}
