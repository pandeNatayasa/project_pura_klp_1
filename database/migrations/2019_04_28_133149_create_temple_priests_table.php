<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplePriestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temple_priests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('priest_name',255);
            $table->text('address');
            $table->string('phone',20);

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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('temple_priests');
        Schema::enableForeignKeyConstraints();
        
    }
}
