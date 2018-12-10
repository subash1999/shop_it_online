<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('offer_id');
            $table->integer('sp_id')->unsigned()->nullable();
            $table->foreign('sp_id')->references('sp_id')->on('seller_products')->onDelete('cascade');
            $table->integer('pac_id')->unsigned()->nullable();
            $table->foreign('pac_id')->references('pac_id')->on('packages')->onDelete('cascade');
            $table->dateTime('from');
            $table->dateTime('to')->nullable();
            $table->string('offer_photo1',1000)->nullable();
            $table->string('offer_photo2',1000)->nullable();
            $table->text('offer_description')->nullable();
            $table->string('offer_name1',1000)->nullable();
            $table->string('offer_name2',1000)->nullable();
            $table->string('offer_name3',1000)->nullable();           
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
        Schema::dropIfExists('offers');
    }
}
