<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Admin', function (Blueprint $table) {
            $table->string('name')
                ->nullable()
                ->after('isSuper')
                ->comment('廠商名稱');
            $table->string('area')
                ->nullable()
                ->after('email')
                ->comment('區域');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Admin', function (Blueprint $table) {
            //
        });
    }
}
