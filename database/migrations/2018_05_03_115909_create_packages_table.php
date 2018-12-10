<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('pac_id');
            $table->string('pac_name1',500);
            $table->string('pac_name2',500)->nullable();
            $table->string('pac_name3',500)->nullable();
            $table->dateTime('from');
            $table->dateTime('to')->nullable();
            $table->string('pac_photo1',1000)->nullable();
            $table->string('pac_photo2',1000)->nullable();
            $table->text('pac_description')->nullable();            
            $table->integer('qty');
            $table->integer('sold');
            $table->integer('available');
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
        Schema::dropIfExists('packages');
    }
}
