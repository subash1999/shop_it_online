<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoProductDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_product_divisions', function (Blueprint $table) {
            $table->increments('apd_id');
            $table->integer('sp_id')->unsigned()->unique();
            $table->foreign('sp_id')->references('sp_id')->on('seller_products')->onDelete('cascade');
            $table->float('min_wholesale_off')->nullable();
            $table->float('min_wholesale_on')->nullable();
            $table->float('min_retail_off')->nullable();
            $table->float('min_retail_on')->nullable();
            $table->float('max_wholesale_off')->nullable();
            $table->float('max_wholesale_on')->nullable();
            $table->float('max_retail_off')->nullable();
            $table->float('max_retail_on')->nullable();
            $table->float('per_wholesale_off')->nullable();
            $table->float('per_wholesale_on')->nullable();
            $table->float('per_retail_off')->nullable();
            $table->float('per_retail_on')->nullable();
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
        Schema::dropIfExists('auto_product_divisions');
    }
}
