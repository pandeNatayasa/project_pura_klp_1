<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temples', function (Blueprint $table) {
            $table->increments('id');
            $table->string('temple_name',255);
            $table->text('address');
            $table->double('longitude');
            $table->double('latitude');
            $table->unsignedInteger('temple_type_id');
            $table->unsignedInteger('odalan_id');
            $table->enum('odalan_type',['wuku','sasih']);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('admin_id');
            $table->enum('validate_status',['0','1']);
            $table->datetime('date_validate');
            $table->unsignedInteger('temple_priest_id');
            $table->unsignedInteger('sub_district_id');
            $table->timestamps();

            Schema::disableForeignKeyConstraints();
            $table->foreign('temple_type_id')->references('id')->on('temple_types');
            $table->foreign('odalan_id')->references('id')->on('odalans');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->foreign('temple_priest_id')->references('id')->on('temple_priests');    
            $table->foreign('sub_district_id')->references('id')->on('sub_districts');    
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
        Schema::dropIfExists('temples');
        Schema::enableForeignKeyConstraints();
    }
}
