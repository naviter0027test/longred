<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Account', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account');
            $table->string('password');
            $table->string('name')
                ->nullable();
            $table->string('email')
                ->nullable();
            $table->string('phone')
                ->nullable();
            $table->string('area')
                ->nullable();
            $table->tinyInteger('active')
                ->comment('0:未啟用, 1:啟用');
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
        Schema::dropIfExists('Account');
    }
}
