<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Message', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content')
                ->comment('訊息內容');
            $table->tinyInteger('type')
                ->comment('1:最新消息,2:公告,3:案件回覆,4:補件通知,5:案件狀態更新');
            $table->integer('recordId')
                ->nullable()
                ->comment('當type為3,4,5. 要記錄是哪個案件');
            $table->string('who')
                ->nullable()
                ->comment('當type為3 要記錄是誰留言.ex管理者或申請者');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Message');
    }
}
