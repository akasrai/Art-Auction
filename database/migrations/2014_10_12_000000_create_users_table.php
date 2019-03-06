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
            $table->increments('id');
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->string('gender')->nullable();
            $table->string('email')->unique();
            $table->string('verify_token')->nullable();
            $table->boolean('status')->default('0');
            $table->date('dob')->nullable();
            $table->string('country')->nulable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone_no')->nullable();
            $table->boolean('update')->nullable();
            $table->string('language')->default('en');
            $table->string('currency')->default('USD');
            $table->string('image')->nullable();
            $table->dateTime('last_login');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
