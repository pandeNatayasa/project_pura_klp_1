<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempleElementImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temple_element_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_name',255);
            $table->unsignedInteger('temple_detail_id');
            $table->timestamps();

             Schema::disableForeignKeyConstraints();
            $table->foreign('temple_detail_id')->references('id')->on('temple_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('temple_element_images');
        Schema::enableForeignKeyConstraints();
        
    }
}
