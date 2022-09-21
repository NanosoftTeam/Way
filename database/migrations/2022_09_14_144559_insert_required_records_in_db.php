<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertRequiredRecordsInDb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert(
            array(
                'name' => 'admin_wayapp_default',
                'email' => 'admin_wayapp_default@wayapp-default.wayapp.default',
                'created_at' => date('Y-m-d H:i:s'),
                'role' => 4,
                'password' => Hash::make('admin_wayapp_default_password')
            )
        );

        DB::table('settings')->insert(
            array(
                ['id' => 1],
                ['id' => 2],
                ['id' => 3],
                ['id' => 4],
                ['id' => 5],
                ['id' => 6],
                ['id' => 7],
                ['id' => 8],
                ['id' => 9],
                ['id' => 10],
                ['id' => 11],
                ['id' => 12],
                ['id' => 13],
                ['id' => 14],
                ['id' => 15],
                ['id' => 16],
                ['id' => 17],
                ['id' => 18]             
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
