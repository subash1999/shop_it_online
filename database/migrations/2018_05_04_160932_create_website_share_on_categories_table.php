<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteShareOnCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_share_on_categories', function (Blueprint $table) {
            $table->increments('wsoc_id');
            $table->integer('cate_id')->unsigned()->unique();
            $table->foreign('cate_id')->references('cate_id')->on('categories')->onDelete('cascade');
            $table->float('per_share')->nullable()->default('0');
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
        Schema::dropIfExists('website_share_on_categories');
    }
}
