<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('username')->unique();
            $table->text('password');
            $table->string('email')->unique();   
            $table->timestamp('email_verified_at')->nullable();         
            $table->string('user_verify','20')->default('NO')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->string('online_status')->default('Online');
            $table->string('Show_last_online')->default('YES');
            $table->dateTime('last_online')->nullable();
            $table->integer('curr_id')->unsigned()->nullable();
            $table->foreign('curr_id')->references('curr_id')->on('currencies')->onDelete('cascade');  
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
