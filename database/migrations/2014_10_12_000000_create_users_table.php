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
            $table->string('lname');   
            //$table->string('gender');        
            $table->string('email')->unique();
            $table->string('verify_token')->nullable();
            $table->boolean('status')->nullable('0');
            // $table->date('dob');
            // $table->string('country');
            // $table->string('state');
            // $table->string('postal_code');
            // $table->string('phone_no');
            // $table->boolean('update');
            // $table->int('trip_count');
            // $table->int('latest_rjn_clicked');
            // $table->int('latest_trip_clicked');
            // $table->int('frequently_rjn_clicked');
            // $table->int('frequently_trip_clicked');
            // $table->string('ip');
            // $table->string('latitude');
            // $table->string('longitude');
            // $table->string('ip');
            // $table->string('notification');
            // $table->string('language');
            // $table->string('currency');
            // $table->string('distance');
            $table->string('image')->nullable();
            $table->string('password');
            //$table->string('api_token',60)->unique();
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
