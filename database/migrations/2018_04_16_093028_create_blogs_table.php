<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->integer('auther_id')->unsigned();
            $table->string('title');
            $table->longtext('body');
            $table->text('excerpt');
            $table->string('featured_image');
            $table->integer('status')->default(1);
            $table->integer('type')->unsigned()->default(1);
            $table->integer('comment_count')->unsigned();
            $table->dateTime('published_at');
            $table->timestamps();

            $table->foreign('auther_id')
                    ->references('id')->on('admins')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
