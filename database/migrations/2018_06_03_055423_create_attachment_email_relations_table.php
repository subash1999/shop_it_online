<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentEmailRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachment_email_relations', function (Blueprint $table) {
            $table->increments('attachment_email_relation_id');
            $table->integer('email_attachment_id')->unsigned()->nullable();
            $table->foreign('email_attachment_id')->references('email_attachment_id')->on('email_attachments')->onDelete('cascade');
            $table->integer('email_id')->unsigned()->nullable();
            $table->foreign('email_id')->references('email_id')->on('emails')->onDelete('cascade');
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
        Schema::dropIfExists('attachment_email_relations');
    }
}
