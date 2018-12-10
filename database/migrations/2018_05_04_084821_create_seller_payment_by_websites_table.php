<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerPaymentByWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_payment_by_websites', function (Blueprint $table) {
            $table->increments('spbw_id');
            $table->float('total');
            $table->float('website_share');
            $table->float('SellerNet');
            $table->integer('th_id')->unsigned();
            $table->foreign('th_id')->references('th_id')->on('transistion_histories')->onDelete('cascade');
            $table->integer('seller_pay_id')->unsigned();
            $table->foreign('seller_pay_id')->references('seller_pay_id')->on('seller_payments')->onDelete('cascade');
            $table->string('is_paid',20)->default('NO');
            $table->dateTime('paid_at')->nullable();
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
        Schema::dropIfExists('seller_payment_by_websites');
    }
}
