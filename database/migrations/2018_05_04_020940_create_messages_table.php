<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('message_id');
            $table->integer('from_user_id')->unsigned();
            $table->foreign('from_user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->integer('to_user_id')->unsigned();
            $table->foreign('to_user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->text('message');
            $table->text('photo')->nullable();
            $table->string('sent',20)->default('NO');
            $table->string('seen',20)->default('NO');
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
        Schema::dropIfExists('messages');
    }
}
