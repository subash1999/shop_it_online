<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryProductRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_product_relations', function (Blueprint $table) {
            $table->increments('cat_pr_id');
            $table->integer('cate_id')->unsigned();
            $table->foreign('cate_id')->references('cate_id')->on('categories')->onDelete('cascade');
            $table->integer('p_id')->unsigned();
            $table->foreign('p_id')->references('p_id')->on('products')->onDelete('cascade');
            $table->string('is_verified',20)->default('No');
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
        Schema::dropIfExists('category_product_relations');
    }
}
