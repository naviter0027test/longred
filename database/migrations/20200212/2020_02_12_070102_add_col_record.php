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
            $table->string('otherDoc2')
                ->default('')
                ->after('otherDoc')
                ->comment('其他文件2');
            $table->string('otherDoc3')
                ->default('')
                ->after('otherDoc2')
                ->comment('其他文件3');
            $table->string('otherDoc4')
                ->default('')
                ->after('otherDoc3')
                ->comment('其他文件4');
            $table->string('otherDoc5')
                ->default('')
                ->after('otherDoc4')
                ->comment('其他文件5');
            $table->string('otherDoc6')
                ->default('')
                ->after('otherDoc5')
                ->comment('其他文件6');
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
