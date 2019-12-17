<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account');
            $table->string('password');
            $table->tinyInteger('active')
                ->default(0)
                ->comment('0:未啟用, 1:啟用');
            $table->tinyInteger('isSuper')
                ->default(0)
                ->comment('是否是抄給使用者?  0:否, 1:是');
            $table->string('phone')
                ->nullable();
            $table->string('email')
                ->nullable();
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
        Schema::dropIfExists('Admin');
    }
}
