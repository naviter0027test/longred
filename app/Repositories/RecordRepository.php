<?php

namespace App\Repositories;

use App\Record;

class RecordRepository
{
    public function create($params, $files = []) {
        $today = date('Y-m-d');
        $recordCount = Record::where('created_at', '>=' , "$today 00:00:00")
            ->where('created_at', '<=', "$today 23:59:59")
            ->count();
        $submitId = date('Ymd'). str_pad($recordCount+1, 5, '0', STR_PAD_LEFT);
        $record = new Record();
        $record->submitId = $submitId;
        $record->CustGID = isset($params['CustGID']) ? $params['CustGID'] : '';
        $record->applicant = isset($params['applicant']) ? $params['applicant'] : '';
        $record->checkStatus = '處理中';
        $record->inCharge = '';
        $record->productName = isset($params['productName']) ? $params['productName'] : '';
        $record->applyAmount = isset($params['applyAmount']) ? $params['applyAmount'] : 0;
        $record->loanAmount = 0;
        $record->periods = 0;
        $record->periodAmount = 0;
        $record->content = '';
        $record->schedule = '尚未撥款';
        $record->grantAmount = 0;
        $record->liense = isset($params['liense']) ? $params['liense'] : '';
        $record->ProjectCategory = '';
        $record->save();

        $root = config('filesystems')['disks']['uploads']['root'];
        $path = date('/Y/m'). '/';
        if(isset($files['CustGIDPicture1'])) {
            $ext = $files['CustGIDPicture1']->getClientOriginalExtension();
            $filename = $record->id. "_pic1.$ext";
            $record->CustGIDPicture1 = $path. $filename;
            $record->save();
            $files['CustGIDPicture1']->move($root. $path, $filename);
        }
        if(isset($files['CustGIDPicture2'])) {
            $ext = $files['CustGIDPicture2']->getClientOriginalExtension();
            $filename = $record->id. "_pic2.$ext";
            $record->CustGIDPicture2 = $path. $filename;
            $record->save();
            $files['CustGIDPicture2']->move($root. $path, $filename);
        }
    }

    public function lists($params) {
        $nowPage = isset($params['nowPage']) ? $params['nowPage'] : 1;
        $offset = isset($params['offset']) ? $params['offset'] : 10;

        $recordQuery = Record::orderBy('id', 'desc')
            ->skip(($nowPage-1) * $offset)
            ->take($offset);
        if(isset($params['checkStatus'])) {
            $recordQuery->where('checkStatus', '=', $params['checkStatus']);
        }
        if(isset($params['schedule'])) {
            $recordQuery->where('schedule', '=', $params['schedule']);
        }
        $records = $recordQuery->get();
        return $records;
    }

    public function listsAmount($params) {
        $recordQuery = Record::orderBy('id', 'desc');
        if(isset($params['checkStatus'])) {
            $recordQuery->where('checkStatus', '=', $params['checkStatus']);
        }
        if(isset($params['schedule'])) {
            $recordQuery->where('schedule', '=', $params['schedule']);
        }
        return $recordQuery->count();
    }
}
