<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id',true);
            $table->integer('hall_id')->unsigned();
            $table->date('date');
            $table->string('fname');
            $table->string('lname');
            $table->string('contact');
            $table->string('nic');
            $table->string('email');
            $table->boolean('is_confirmed');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
