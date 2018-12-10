<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemUniqueValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_unique_values', function (Blueprint $table) {
            $table->increments('iuv_id');
            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade');
            $table->integer('spup_id')->unsigned();
            $table->foreign('spup_id')->references('spup_id')->on('s_p_unique_properties')->onDelete('cascade');
            $table->text('value');
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
        Schema::dropIfExists('item_unique_values');
    }
}
