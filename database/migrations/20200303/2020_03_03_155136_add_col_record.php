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
            $table->string('contractId')
                ->default('')
                ->after('submitId')
                ->comment('合約編號');
            $table->string('dealer')
                ->default('')
                ->after('checkStatus')
                ->comment('經銷商名稱');
            $table->string('beneficiary')
                ->default('')
                ->after('inCharge')
                ->comment('受款廠商');
            $table->string('dealerName')
                ->default('')
                ->after('grantAmount')
                ->comment('經銷商名稱');
            $table->string('inChargeName')
                ->default('')
                ->after('dealerName')
                ->comment('經辦廠商名稱');
            $table->string('beneficiaryName')
                ->default('')
                ->after('inChargeName')
                ->comment('受款廠商名稱');
            $table->string('product')
                ->default('')
                ->after('allowDate')
                ->comment('商品型號');
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
