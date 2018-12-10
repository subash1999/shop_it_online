<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reward_histories', function (Blueprint $table) {
            $table->increments('reward_h_id');
            $table->integer('reward_id')->unsigned();
            $table->foreign('reward_id')->references('reward_id')->on('rewards')->onDelete('cascade');
            $table->float('prev_value')->unsigned();
            $table->float('changed_by_value');
            $table->float('new_value')->unsigned();
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
        Schema::dropIfExists('reward_histories');
    }
}
