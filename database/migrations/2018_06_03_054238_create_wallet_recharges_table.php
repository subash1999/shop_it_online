<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletRechargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_recharges', function (Blueprint $table) {
            $table->increments('wallet_recharge_id');
            $table->integer('curr_id')->unsigned()->nullable();
            $table->foreign('curr_id')->references('curr_id')->on('currencies')->onDelete('cascade');
            $table->float('value');
            $table->text('code');
            $table->string('is_used',20);
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
        Schema::dropIfExists('wallet_recharges');
    }
}
