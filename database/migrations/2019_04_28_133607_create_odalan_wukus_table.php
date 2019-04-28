<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOdalanWukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odalan_wukus', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('saptawara_id');
            $table->unsignedInteger('pancawara_id');
            $table->unsignedInteger('wuku_id');
            $table->timestamps();

            Schema::disableForeignKeyConstraints();
            $table->foreign('saptawara_id')->references('id')->on('saptawaras');
            $table->foreign('pancawara_id')->references('id')->on('pancawaras');
            $table->foreign('wuku_id')->references('id')->on('wukus');
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
        Schema::dropIfExists('odalan_wukus');
        Schema::enableForeignKeyConstraints();
        
    }
}
