<?php

namespace App\Repositories;

use App\Record;
use Exception;

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

    public function import($file) {
        $content = \File::get($file->getRealPath());
        $arr = preg_split("/\n/", $content);
        $resultRow = [];
        foreach($arr as $i => $row) {
            try {
                $csv = str_getcsv($row, ",");
                $this->importRow($csv);
                $resultRow[$i] = [
                    'status' => true,
                    'msg' => 'success',
                ];
            } catch (\Exception $e) {
                $resultRow[$i] = [
                    'status' => false,
                    'msg' => $e->getMessage(),
                ];
            }
        }
        return $resultRow;
    }

    public function importRow($row) {
        if(isset($row[0]) == false) {
            throw new \Exception('submitId 必填');
        }
        $record = Record::where('submitId', '=', $row[0])
            ->first();
        //已存在的情況下，視為編輯。相反則是為新增
        if(isset($record->id)) {
        } else {
            $record = new Record;
            $record->submitId = isset($row[0]) ? $row[0] : '';
            $record->applicant = isset($row[2]) ? $row[2] : '';
            $record->checkStatus = isset($row[3]) ? $row[3] : '處理中';
            $record->applyAmount = isset($row[9]) ? $row[9] : 0;
            $record->loanAmount = isset($row[10]) ? $row[10] : 0;
            $record->periods = isset($row[11]) ? $row[11] : 1;
            $record->periodAmount = isset($row[12]) ? $row[12] : 0;
            $record->content = isset($row[13]) ? $row[13] : '';
            $record->schedule = isset($row[14]) ? $row[14] : '尚未撥款';
            //$record->grantDate = $row[23];
            $record->grantAmount = isset($row[16]) ? $row[16] : 0;
            $record->liense = isset($row[20]) ? $row[20] : '';
            $record->productName = isset($row[24]) ? $row[24] : '';
            $record->CustGID = isset($row[25]) ? $row[25] : '';
        }
        $record->save();
    }

    public function getById($id) {
        $record = Record::where('id', '=', $id)
            ->first();
        if(isset($record->id) == false) {
            throw new Exception('案件不存在');
        }
        if(is_null($record->allowDate) == false)
            $record->allowDateVal = date('Y-m-d', strtotime($record->allowDate));
        if(is_null($record->grantDate) == false)
            $record->grantDateVal = date('Y-m-d', strtotime($record->grantDate));
        return $record;
    }
}
