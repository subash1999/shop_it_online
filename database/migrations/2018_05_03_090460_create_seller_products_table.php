<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_products', function (Blueprint $table) {
            $table->increments('sp_id');
            $table->integer('seller_id')->unsigned();
            $table->foreign('seller_id')->references('seller_id')->on('sellers')->onDelete('cascade');
            $table->integer('p_id')->unsigned();
            $table->foreign('p_id')->references('p_id')->on('products')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->integer('qty');
            $table->string('sp_name1',1000);
            $table->string('sp_name2',1000)->nullable();
            $table->string('sp_name3',1000)->nullable();
            $table->string('sp_name4',1000)->nullable();
            $table->string('sp_name5',1000)->nullable();
            $table->integer('sold');
            $table->integer('remaining');
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
        Schema::dropIfExists('seller_products');
    }
}
