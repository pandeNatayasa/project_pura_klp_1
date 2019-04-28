<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOdalanSasihsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odalan_sasihs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sasih_id');
            $table->unsignedInteger('rahinan_id');
            $table->timestamps();

            Schema::disableForeignKeyConstraints();
            $table->foreign('sasih_id')->references('id')->on('sasihs');
            $table->foreign('rahinan_id')->references('id')->on('rahinans')->onDelete('cascade');
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
        Schema::dropIfExists('odalan_sasihs');
        Schema::enableForeignKeyConstraints();
    }
}
