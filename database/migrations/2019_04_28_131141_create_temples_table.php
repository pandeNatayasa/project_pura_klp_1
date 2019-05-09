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
            $table->text('description');
            $table->text('address');
            $table->double('longitude')->nullable();
            $table->double('latitude')->nullable();
            $table->unsignedInteger('temple_type_id');
            $table->unsignedInteger('odalan_id')->nullable();
            $table->enum('odalan_type',['wuku','sasih']);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('admin_id')->nullable();
            $table->enum('validate_status',['0','1','2']); // 0=not validate, 1=validate, 2=reject
            $table->datetime('date_validate')->nullable();
            $table->string('priest_name',255);
            $table->text('priest_address');
            $table->string('priest_phone',20);
            $table->unsignedInteger('sub_district_id');
            $table->timestamps();

            Schema::disableForeignKeyConstraints();
            $table->foreign('temple_type_id')->references('id')->on('temple_types');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('admin_id')->references('id')->on('admins');
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
