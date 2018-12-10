<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_type_permissions', function (Blueprint $table) {
            $table->increments('ut_permission_id');
            $table->integer('ut_id')->unsigned()->nullable();
            $table->foreign('ut_id')->references('ut_id')->on('user_types')->onDelete('cascade');
            $table->text('link')->nullable();
            $table->text('permission_name');
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
        Schema::dropIfExists('user_type_permissions');
    }
}
