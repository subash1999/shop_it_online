<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemShipmentRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_shipment_relations', function (Blueprint $table) {
            $table->increments('item_ship_rel_id');
            $table->integer('shipment_id')->unsigned();
            $table->foreign('shipment_id')->references('shipment_id')->on('shipments')->onDelete('cascade');
            $table->integer('item_id')->unsigned()->unique();
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade');
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
        Schema::dropIfExists('item_shipment_relations');
    }
}
