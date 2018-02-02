<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id',true);
            $table->string('fname');
            $table->string('lname');
            $table->string('username');
            $table->boolean('is_active');
            $table->string('password');
            $table->string('email',30);
            $table->string('contact');
            $table->string('verify_mail');
            $table->boolean('is_verified');
            $table->integer('fees');
            $table->date('expire');
            $table->string('paypal_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
