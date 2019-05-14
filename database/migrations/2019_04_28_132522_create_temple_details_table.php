<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temple_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('element_name',255);
            $table->string('god',255)->nullable();
            $table->text('element_description')->nullable();
            $table->text('element_position')->nullable();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('temple_details');
        Schema::enableForeignKeyConstraints();
        
    }
}
