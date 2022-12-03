<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NullableAndDefaultWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('words', function (Blueprint $table) {
            $table->string('name_info', 500)->nullable()->change();
            $table->string('translation_info', 500)->nullable()->change();
            $table->boolean('mw')->default(false)->change(); //multisłowa
            $table->boolean('iw')->default(false)->change(); //multisłowaodmiana
            $table->boolean('mt')->default(false)->change(); //multitłumaczenia
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
