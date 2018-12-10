<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration 
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('cus_id');
            $table->integer('user_id')->unsigned()->unique();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->text('first_name');
            $table->text('last_name');
            $table->dateTime('dob')->nullable();
            $table->string('gender',20);
            $table->string('email1')->unique();
            $table->string('email2')->unique()->nullable();
            $table->string('add1', 500)->nullable();
            $table->string('add2', 500)->nullable();
            $table->string('phone1', 30)->unique()->nullable();
            $table->string('phone2', 30)->unique()->nullable();
            $table->string('city',500);
            $table->string('country', 500);
            $table->string('postal_code', 50)->nullable();
            $table->string('fax', 100)->nullable();
            $table->string('photo')->unique()->nullable();
            $table->string('identity')->unique()->nullable();
            $table->string('email1_verify', 20)->default('NO');
            $table->string('email2_verify', 20)->default('NO');
            $table->string('phone1_verify', 20)->default('NO');
            $table->string('phone2_verify', 20)->default('NO');
            $table->string('photo_verify', 20)->default('NO');
            $table->string('identity_verify', 20)->default('NO');         
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
        Schema::dropIfExists('customers');
    }
}
