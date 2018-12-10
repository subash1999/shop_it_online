<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('bill_id');
            $table->string('name',1000);
            $table->string('bill_address',500);
            $table->string('bill_country',500);
            $table->string('bill_city',500);
            $table->string('ship_address',500);
            $table->string('ship_country',500);
            $table->string('ship_city',500);
            $table->string('postal_code',50)->nullable();
            $table->string('phone1',50);
            $table->string('phone2',50)->nullable();
            $table->string('email',500);
            $table->integer('spsd_id')->unsigned()->nullable();
            $table->foreign('spsd_id')->references('spsd_id')->on('s_p_sub_divisions')->onDelete('cascade');
            $table->string('payment_status',500)->default('Pending');
            $table->string('product_status',500)->default('To be Confirmed');
            $table->integer('dc_id')->unsigned()->nullable();
            $table->foreign('dc_id')->references('dc_id')->on('discount_coupons')->onDelete('cascade');
            $table->float('discount_amount');
            $table->float('total_amount');
            $table->float('final_amount');
            $table->integer('curr_id')->unsigned();
            $table->foreign('curr_id')->references('curr_id')->on('currencies')->onDelete('cascade');
             $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');       
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
        Schema::dropIfExists('bills');
    }
}
