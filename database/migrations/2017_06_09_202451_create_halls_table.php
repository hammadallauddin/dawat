<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('halls', function (Blueprint $table) {
            $table->increments('id',true);
            $table->string('name');
            $table->integer('user_id')->unsigned();;
            $table->integer('area_id')->unsigned();;
            $table->integer('capacity');
            $table->integer('min_price');
            $table->integer('max_price');
            $table->string('contact');
            $table->text('desc',80);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('halls');
    }
}
