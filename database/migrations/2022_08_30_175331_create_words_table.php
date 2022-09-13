<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('translation');
            $table->integer('wordlist_id');
            $table->string('name_info', 500);
            $table->string('translation_info', 500);
            $table->boolean('mw'); //multisłowa
            $table->boolean('iw'); //odmiana
            $table->boolean('mt'); //multitłumaczenia
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
        Schema::dropIfExists('words');
    }
}
