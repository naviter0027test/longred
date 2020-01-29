<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Record', function (Blueprint $table) {
            $table->integer('accountId')
                ->nullable()
                ->after('ProjectCategory')
                ->comment('由哪位使用者建立');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Record', function (Blueprint $table) {
            //
        });
    }
}
