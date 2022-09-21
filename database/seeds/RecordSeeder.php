<?php

use Illuminate\Database\Seeder;
use App\Record;

class RecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 20; ++$i) {
            $strHour = str_pad($i, 2, '0', STR_PAD_LEFT);
            $record = new Record();
            $record->id = $i;
            $submitId = '200902A'. str_pad($i+1, 3, '0', STR_PAD_LEFT). '10';
            $record->submitId = $submitId;
            $record->contractId = '';
            $record->CustGID = '';
            $record->CustGIDPicture1 = '';
            $record->CustGIDPicture2 = '';
            $record->applyUploadPath = '';
            $record->proofOfProperty = '';
            $record->otherDoc = '';
            $record->otherDoc2 = '';
            $record->otherDoc3 = '';
            $record->otherDoc4 = '';
            $record->otherDoc5 = '';
            $record->otherDoc6 = '';
            $record->applicant = '';
            $record->checkStatus = '';
            $record->dealer = '';
            $record->inCharge = '';
            $record->beneficiary = '';
            $record->allowDate = '2020-09-03 14:00:00';
            $record->product = '';
            $record->productName = '';
            $record->applyAmount = 0;
            $record->loanAmount = 0;
            $record->periods = 0;
            $record->periodAmount = 0;
            $record->content = '';
            $record->schedule = '';
            $record->grantDate = '2020-09-04 15:00:00';
            $record->grantAmount = '0';
            $record->dealerName = '';
            $record->inChargeName = '';
            $record->beneficiaryName = '';
            $record->liense = '';
            $record->ProjectCategory = '';
            $record->SubArea = '';
            $record->memo = '';
            $record->accountId = 1;
            $record->created_at = date('Y-m'). "-01 $strHour:00:00";
            $record->updated_at = date('Y-m'). "-01 $strHour:00:00";
            $record->save();
        }
    }
}
