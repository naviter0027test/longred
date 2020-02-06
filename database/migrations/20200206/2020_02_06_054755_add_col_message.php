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
            $table->tinyInteger('isAsk')
                ->nullable()
                ->after('recordId')
                ->comment('1:使用者留言 2:管理者回覆');
            $table->tinyInteger('type')
                ->comment('1:最新消息,2:公告,3:案件回覆,4:補件通知,5:案件狀態更新,6:案件使用者留言');
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
