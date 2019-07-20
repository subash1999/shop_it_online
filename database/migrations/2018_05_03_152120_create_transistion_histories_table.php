<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransistionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transistion_histories', function (Blueprint $table) {
            $table->increments('th_id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');      
            $table->integer('sp_id')->unsigned();
            $table->foreign('sp_id')->references('sp_id')->on('seller_products')->onDelete('cascade');
            $table->integer('pac_id')->unsigned()->nullable();
            $table->foreign('pac_id')->references('pac_id')->on('packages')->onDelete('cascade');
            $table->integer('offer_id')->unsigned()->nullable();
            $table->foreign('offer_id')->references('offer_id')->on('offers')->onDelete('cascade');
            $table->float('unit_price');
            $table->integer('quantity');
            $table->integer('final_unit_price');
            $table->integer('curr_id')->unsigned();
            $table->foreign('curr_id')->references('curr_id')->on('currencies')->onDelete('cascade');
            $table->integer('spor_id');
            // $table->foreign('spor_id')->references('spor_id')->on('s_p_option_relations')->onDelete('cascade');
            $table->integer('spsd_id')->unsigned()->nullable();
            $table->foreign('spsd_id')->references('spsd_id')->on('s_p_sub_divisions')->onDelete('cascade');
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
        Schema::dropIfExists('transistion_histories');
    }
}
