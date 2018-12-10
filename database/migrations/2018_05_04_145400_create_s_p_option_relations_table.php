<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSPOptionRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_p_option_relations', function (Blueprint $table) {
            $table->increments('spor_id');
            $table->integer('option_id')->unsigned();    
            $table->foreign('option_id')->references('option_id')->on('options')->onDelete('cascade');
            $table->integer('sp_id')->unsigned();
            $table->foreign('sp_id')->references('sp_id')->on('seller_products')->onDelete('cascade');
            $table->integer('parent_option_id')->unsigned()->nullable();
            $table->foreign('parent_option_id')->references('option_id')->on('options')->onDelete('cascade');
            $table->integer('number_of_items')->default('0');
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
        Schema::dropIfExists('s_p_option_relations');
    }
}
