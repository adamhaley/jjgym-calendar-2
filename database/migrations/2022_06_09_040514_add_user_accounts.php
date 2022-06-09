<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //add admin accounts for Adam, Jack, and Jeri
        DB::table('users')->insert(
            array(
                'name' => 'Adam Haley',
                'email' => 'adamhaley@gmail.com',
                'password' => 'password'
            )
        );
        DB::table('users')->insert(
            array(
                'name' => 'Jeri Kalvan',
                'email' => 'jeri@kalvan.net',
                'password' => 'password'
            )
        );
        DB::table('users')->insert(
            array(
                'name' => 'Jack Kalvan',
                'email' => 'jack@kalvan.net',
                'password' => 'password'
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
        //
        DB::table('users')->where('name', 'Adam Haley')->delete();
        DB::table('users')->where('name', 'Jack Kalvan')->delete();
        DB::table('users')->where('name', 'Jeri Kalvan')->delete();
    }
};
