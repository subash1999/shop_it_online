<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('payment_id');
            $table->float('price')->nullable();
            $table->integer('bill_id')->unsigned();
            $table->foreign('bill_id')->references('bill_id')->on('bills')->onDelete('cascade');
            $table->integer('pay_state_id')->unsigned();
            $table->foreign('pay_state_id')->references('pay_state_id')->on('payment_states')->onDelete('cascade');
            $table->integer('pay_m_id')->unsigned();
            $table->foreign('pay_m_id')->references('pay_m_id')->on('payment_methods')->onDelete('cascade');
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
        Schema::dropIfExists('payments');
    }
}
