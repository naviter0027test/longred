<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHasRead extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HasRead', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('accountId');
            $table->integer('messageId');
            $table->tinyInteger('isRead')
                ->default(0)
                ->comment('此消息是否已讀 0:未讀，1:已讀');
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
        Schema::dropIfExists('HasRead');
    }
}
