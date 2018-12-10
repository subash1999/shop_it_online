<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_payments', function (Blueprint $table) {
            $table->increments('seller_pay_id');
            $table->integer('seller_id')->unsigned();
            $table->foreign('seller_id')->references('seller_id')->on('sellers')->onDelete('cascade');
            $table->integer('pay_m_id')->unsigned();
            $table->foreign('pay_m_id')->references('pay_m_id')->on('payment_methods')->onDelete('cascade');
            $table->text('username');
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
        Schema::dropIfExists('seller_payments');
    }
}
