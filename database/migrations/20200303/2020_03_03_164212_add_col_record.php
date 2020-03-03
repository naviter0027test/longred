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
            $table->string('SubArea')
                ->default('')
                ->after('ProjectCategory')
                ->comment('承辦廠商區域');
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
