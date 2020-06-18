<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Account', function (Blueprint $table) {
            $table->tinyInteger('tokenMode')
                ->default(1)
                ->after('appleToken')
                ->comment('那家的token. 1:ios token, 2:android token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Account', function (Blueprint $table) {
            //
        });
    }
}
