<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complains', function (Blueprint $table) {
            $table->increments('complain_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->text('subject')->nullable();
            $table->text('complain');
            $table->string('email',500);
            $table->text('reply')->nullable();
            $table->string('replied',20)->default('NO');
            $table->text('complain_photo')->nullable();
            $table->text('reply_photo')->nullable();
            $table->integer('feedback_id')->unsigned()->nullable();
            $table->foreign('feedback_id')->references('feedback_id')->on('feedback')->onDelete('cascade');
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
        Schema::dropIfExists('complains');
    }
}
