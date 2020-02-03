<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Record', function (Blueprint $table) {
            $table->string('proofOfProperty')
                ->default('')
                ->after('applyUploadPath')
                ->comment('財力證明');
            $table->string('otherDoc')
                ->default('')
                ->after('proofOfProperty')
                ->comment('其他文件');
            $table->string('memo')
                ->default('')
                ->after('ProjectCategory')
                ->comment('備註');
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
