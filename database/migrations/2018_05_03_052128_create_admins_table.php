<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('admin_id');
            $table->integer('user_id')->unsigned()->unique();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->text('first_name');
            $table->text('last_name');
            $table->dateTime('dob')->default('1970-01-01 00:00:00');
            $table->string('gender',20);
            $table->string('email1')->unique();
            $table->string('email2')->unique()->nullable();
            $table->string('add1', 500);
            $table->string('add2', 500)->nullable();
            $table->string('phone1', 30)->unique();
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
        Schema::dropIfExists('admins');
    }
}
