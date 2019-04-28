<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempleImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temple_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_name',200);
            $table->text('image_position');
            $table->unsignedInteger('temple_id');
            $table->timestamps();

            Schema::disableForeignKeyConstraints();
            $table->foreign('temple_id')->references('id')->on('temples');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::enableForeignKeyConstraints();
        Schema::dropIfExists('temple_images');
        Schema::enableForeignKeyConstraints();
        
    }
}
