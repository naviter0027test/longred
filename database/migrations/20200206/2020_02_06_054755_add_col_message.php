<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Message', function (Blueprint $table) {
            $table->dropColumn('who');
        });
        Schema::table('Message', function (Blueprint $table) {
            $table->tinyInteger('isAsk')
                ->nullable()
                ->after('recordId')
                ->comment('1:使用者留言 2:管理者回覆');
            $table->integer('who')
                ->nullable()
                ->after('isAsk')
                ->comment('當type為3 要記錄是誰留言');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Message', function (Blueprint $table) {
            //
        });
    }
}
