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
        foreach($records as $record) {
            if(is_null($record->allowDate) == false) {
                $record->allowDate = date('Y-m-d', strtotime($record->allowDate));
            }
            if(is_null($record->grantDate) == false) {
                $record->grantDate = date('Y-m-d', strtotime($record->grantDate));
            }
        }
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

    public function import($file, $admin) {
        $content = \File::get($file->getRealPath());
        $arr = preg_split("/\n/", $content);
        $resultRow = [];
        foreach($arr as $i => $row) {
            try {
                $csv = str_getcsv($row, ",");
                $this->importRow($csv, $admin);
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

    public function importRow($row, $admin) {
        if(isset($row[0]) == false) {
            throw new \Exception('submitId 必填');
        }
        $record = Record::where('submitId', '=', $row[0])
            ->first();
        //已存在的情況下，視為編輯。相反則是為新增
        if(isset($record->id)) {
            $record->applicant = isset($row[2]) ? $row[2] : '';
            $record->applyAmount = isset($row[9]) ? $row[9] : 0;
            $record->loanAmount = isset($row[10]) ? $row[10] : 0;
            $record->periods = isset($row[11]) ? $row[11] : 1;
            $record->periodAmount = isset($row[12]) ? $row[12] : 0;
            $record->content = isset($row[13]) ? $row[13] : '';
            //$record->grantDate = $row[23];
            $record->grantAmount = isset($row[16]) ? $row[16] : 0;
            $record->liense = isset($row[20]) ? $row[20] : '';
            $record->productName = isset($row[24]) ? $row[24] : '';
            $record->CustGID = isset($row[25]) ? $row[25] : '';

            $checkArr = [
                '處理中',
                '待核准',
                '核准',
                '取消申辦',
                '婉拒',
            ];
            if(isset($row[3]) && in_array($row[3], $checkArr) == true) {
                if($record->checkStatus != $row[3]) {
                    $oldStatus = $record->checkStatus;
                    $newStatus = $row[3];
                    $messageRepository = new MessageRepository();
                    $messageRepository->statusUpdate($record->id, "審核狀況:$oldStatus -> $newStatus", $admin->id);
                }
                $record->checkStatus = $row[3];
            }
            $scheduleArr = [
                '已撥款',
                '尚未撥款',
                '支票已出',
            ];
            if(isset($row[14]) && in_array($row[14], $scheduleArr) == true) {
                if($record->schedule != $row[14]) {
                    $oldStatus = $record->schedule;
                    $newStatus = $row[14];
                    $messageRepository = new MessageRepository();
                    $messageRepository->statusUpdate($record->id, "撥款狀況:$oldStatus -> $newStatus", $admin->id);
                }
                $record->schedule = $row[14];
            }
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

    public function updateById($id, $params, $admin, $files = []) {
        $record = Record::where('id', '=', $id)
            ->first();
        if(isset($record->id) == false) {
            throw new Exception('案件不存在');
        }
        $record->CustGID = isset($params['CustGID']) ? $params['CustGID'] : '';
        $record->applicant = isset($params['applicant']) ? $params['applicant'] : '';
        $record->inCharge = isset($params['inCharge']) ? $params['inCharge'] : '';
        if(isset($params['allowDate']) && is_null($params['allowDate']) == false)
            $record->allowDate = $params['allowDate']. ' 00:00:00';
        $record->productName = isset($params['productName']) ? $params['productName'] : '';
        $record->applyAmount = isset($params['applyAmount']) ? $params['applyAmount'] : 0;
        $record->loanAmount = isset($params['loanAmount']) ? $params['loanAmount'] : 0;
        $record->periods = isset($params['periods']) ? $params['periods'] : 0;
        $record->periodAmount = isset($params['periodAmount']) ? $params['periodAmount'] : 0;
        $record->content = isset($params['content']) ? $params['content'] : '';
        if(isset($params['grantDate']) && is_null($params['grantDate']) == false)
            $record->grantDate = $params['grantDate']. ' 00:00:00';
        $record->grantAmount = isset($params['grantAmount']) ? $params['grantAmount'] : 0;
        $record->liense = isset($params['liense']) ? $params['liense'] : '';


        if(isset($params['checkStatus']) && is_null($params['checkStatus']) == false) {
            if($record->checkStatus != $params['checkStatus']) {
                $oldStatus = $record->checkStatus;
                $newStatus = $params['checkStatus'];
                $messageRepository = new MessageRepository();
                $messageRepository->statusUpdate($record->id, "審核狀況:$oldStatus -> $newStatus", $admin->id);
            }
            $record->checkStatus =  $params['checkStatus'];
        }
        if(isset($params['schedule']) && is_null($params['schedule']) == false) {
            if($record->schedule != $params['schedule']) {
                $oldStatus = $record->schedule;
                $newStatus = $params['schedule'];
                $messageRepository = new MessageRepository();
                $messageRepository->statusUpdate($record->id, "撥款狀況:$oldStatus -> $newStatus", $admin->id);
            }
            $record->schedule = $params['schedule'];
        }

        $record->save();

        $root = config('filesystems')['disks']['uploads']['root'];
        $path = date('/Y/m'). '/';
        if(isset($files['CustGIDPicture1'])) {
            if(trim($record->CustGIDPicture1) == '') {
                $ext = $files['CustGIDPicture1']->getClientOriginalExtension();
                $filename = $record->id. "_pic1.$ext";
                $record->CustGIDPicture1 = $path. $filename;
                $record->save();
            } else {
                $splitArr = preg_split("/\//", $record->CustGIDPicture1);
                $path = $splitArr[0]. "/". $splitArr[1]. "/". $splitArr[2]. "/";
                $filename = $splitArr[3];
            }
            $files['CustGIDPicture1']->move($root. $path, $filename);
        }
        if(isset($files['CustGIDPicture2'])) {
            if(trim($record->CustGIDPicture2) == '') {
                $ext = $files['CustGIDPicture2']->getClientOriginalExtension();
                $filename = $record->id. "_pic2.$ext";
                $record->CustGIDPicture2 = $path. $filename;
                $record->save();
            } else {
                $splitArr = preg_split("/\//", $record->CustGIDPicture2);
                $path = $splitArr[0]. "/". $splitArr[1]. "/". $splitArr[2]. "/";
                $filename = $splitArr[3];
            }
            $files['CustGIDPicture2']->move($root. $path, $filename);
        }
    }
}
