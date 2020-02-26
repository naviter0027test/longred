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
            $table->string('appleToken')
                ->default('')
                ->after('active')
                ->comment('apple token存放所在，推播會用到');
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
