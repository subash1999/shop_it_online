<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerPrivaciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_privacies', function (Blueprint $table) {
            $table->increments('cus_pri_id');
            $table->integer('cus_id')->unsigned();
            $table->foreign('cus_id')->references('cus_id')->on('customers')->onDelete('cascade');
            $table->integer('first_name')->unsigned();
            $table->foreign('first_name')->references('pri_id')->on('privacies')->onDelete('cascade');            
            $table->integer('middle_name')->unsigned();
            $table->foreign('middle_name')->references('pri_id')->on('privacies')->onDelete('cascade');            
            $table->integer('last_name')->unsigned();
            $table->foreign('last_name')->references('pri_id')->on('privacies')->onDelete('cascade');
            $table->integer('dob')->unsigned();            
            $table->foreign('dob')->references('pri_id')->on('privacies')->onDelete('cascade');            
            $table->integer('email1')->unsigned();
            $table->foreign('email1')->references('pri_id')->on('privacies')->onDelete('cascade');            
            $table->integer('email2')->unsigned();
            $table->foreign('email2')->references('pri_id')->on('privacies')->onDelete('cascade');            
            $table->integer('add1')->unsigned();
            $table->foreign('add1')->references('pri_id')->on('privacies')->onDelete('cascade');            
            $table->integer('add2')->unsigned();
            $table->foreign('add2')->references('pri_id')->on('privacies')->onDelete('cascade');            
            $table->integer('phone1')->unsigned();
            $table->foreign('phone1')->references('pri_id')->on('privacies')->onDelete('cascade');            
            $table->integer('phone2')->unsigned();
            $table->foreign('phone2')->references('pri_id')->on('privacies')->onDelete('cascade');            
            $table->integer('city')->unsigned();
            $table->foreign('city')->references('pri_id')->on('privacies')->onDelete('cascade');            
            $table->integer('country')->unsigned();
            $table->foreign('country')->references('pri_id')->on('privacies')->onDelete('cascade');            
            $table->integer('postal_code')->unsigned();
            $table->foreign('postal_code')->references('pri_id')->on('privacies')->onDelete('cascade');            
            $table->integer('fax')->unsigned();
            $table->foreign('fax')->references('pri_id')->on('privacies')->onDelete('cascade');            
            $table->integer('photo')->unsigned();
            $table->foreign('photo')->references('pri_id')->on('privacies')->onDelete('cascade');            
            $table->integer('identity')->unsigned();
            $table->foreign('identity')->references('pri_id')->on('privacies')->onDelete('cascade');            
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
        Schema::dropIfExists('customer_privacies');
    }
}
