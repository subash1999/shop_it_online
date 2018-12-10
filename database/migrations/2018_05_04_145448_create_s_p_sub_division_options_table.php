<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSPSubDivisionOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_p_sub_division_option_relations', function (Blueprint $table) {
            $table->increments('spsdor_id');
            $table->integer('spsd_id')->unsigned();
            $table->foreign('spsd_id')->references('spsd_id')->on('s_p_sub_divisions')->onDelete('cascade');
            $table->integer('spor_id')->unsigned();
            $table->foreign('spor_id')->references('spor_id')->on('s_p_option_relations')->onDelete('cascade');      
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
        Schema::dropIfExists('s_p_sub_division_option_relations');
    }
}
