<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('channel');
            $table->integer('category');
            $table->integer('p_episodes')->nullable();
            $table->string('yt')->nullable();
            $table->string('scenario')->nullable();
            $table->integer('status');
            $table->string('description', 700)->nullable();
            $table->string('goal', 700)->nullable();
            $table->string('longstatus', 400)->nullable();
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
        Schema::dropIfExists('courses');
    }
}
