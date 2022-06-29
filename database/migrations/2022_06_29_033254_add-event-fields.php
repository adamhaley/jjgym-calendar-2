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
        //
        Schema::table('events', function($table) {
            $table->text('name')->after('end');
            $table->integer('num_people')->after('name');
            $table->text('note')->after('num_people');
            $table->text('contact')->after('note');
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
        Schema::table('events', function($table) {
            $table->dropColumn(['name', 'num_people', 'note', 'contact']);
        });
    }
};
