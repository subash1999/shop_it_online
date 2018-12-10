<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillTransistionRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_transistion_relations', function (Blueprint $table) {
            $table->increments('btr_id');
            $table->integer('bill_id')->unsigned();
            $table->foreign('bill_id')->references('bill_id')->on('bills')->onDelete('cascade');
            $table->integer('th_id')->unsigned()->unique();
            $table->foreign('th_id')->references('th_id')->on('transistion_histories')->onDelete('cascade');
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
        Schema::dropIfExists('bill_transistion_relations');
    }
}
