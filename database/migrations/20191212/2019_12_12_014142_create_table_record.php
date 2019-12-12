<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Record', function (Blueprint $table) {
            $table->increments('id');
            $table->string('CustGID')
                ->default('')
                ->comment('身份證字號');
            $table->string('CustGIDPicture1')
                ->default('')
                ->comment('身份證正面 path');
            $table->string('CustGIDPicture2')
                ->default('')
                ->comment('身份證反面 path');
            $table->string('applyUploadPath')
                ->default('')
                ->comment('申請文件 path');
            $table->string('applicant')
                ->default('')
                ->comment('申請人姓名');
            $table->string('checkStatus')
                ->default('')
                ->comment('審核狀況。狀態：處理中、待核准、核准、取消申辦、婉拒');
            $table->string('inCharge')
                ->default('')
                ->comment('經辦廠商');
            $table->dateTime('allowDate')
                ->nullable()
                ->comment('準駁日期');
            $table->string('productName')
                ->default('')
                ->comment('商品名稱');
            $table->integer('applyAmount')
                ->default(0)
                ->comment('申貸金額');
            $table->integer('loanAmount')
                ->default(0)
                ->comment('核貸金額');
            $table->integer('periods')
                ->default(0)
                ->comment('核准期數');
            $table->integer('periodAmount')
                ->default(0)
                ->comment('期付金額');
            $table->string('content')
                ->default('')
                ->comment('批單內容');
            $table->string('schedule')
                ->default('尚未撥款')
                ->comment('撥款狀態. 狀態：已撥款、尚未撥款、支票已出');
            $table->dateTime('grantDate')
                ->nullable()
                ->comment('撥款日期');
            $table->integer('grantAmount')
                ->default(0)
                ->comment('撥款金額');
            $table->string('liense')
                ->default('')
                ->comment('車牌號碼');
            $table->string('ProjectCategory')
                ->default('')
                ->comment('動產設定');
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
        Schema::dropIfExists('Record');
    }
}
