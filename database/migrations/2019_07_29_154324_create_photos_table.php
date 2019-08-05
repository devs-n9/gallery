<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('preview');
            $table->string('image');
            $table->text('description')->nullable();
            $table->tinyInteger('private')->default(1);
            $table->text('data')->nullable();
            $table->unsignedInteger('gallery_id');
            $table->timestamps();
            
            $table->foreign('gallery_id')
              ->references('id')->on('gallery')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
