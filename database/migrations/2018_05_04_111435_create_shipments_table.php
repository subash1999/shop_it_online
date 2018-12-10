<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->increments('shipment_id');
            $table->integer('ship_m_id')->unsigned();
            $table->foreign('ship_m_id')->references('ship_m_id')->on('shipment_methods')->onDelete('cascade');
            $table->integer('ship_state_id')->unsigned();
            $table->foreign('ship_state_id')->references('ship_state_id')->on('shipment_states')->onDelete('cascade');
            $table->float('ship_charge')->nullable();
            $table->dateTime('ship_date');
            $table->dateTime('delivery_date')->nullable();
            $table->dateTime('expected_delivery_date')->nullable();
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
        Schema::dropIfExists('shipments');
    }
}
