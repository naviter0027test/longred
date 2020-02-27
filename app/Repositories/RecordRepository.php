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
        $record->schedule = '';
        $record->grantAmount = 0;
        $record->liense = isset($params['liense']) ? $params['liense'] : '';
        $record->ProjectCategory = '';
        $record->memo = isset($params['memo']) ? $params['memo'] : '';
        $record->created_at = date('Y-m-d H:i:s');
        $record->updated_at = date('Y-m-d H:i:s');
        if(isset($params['accountId']))
            $record->accountId = $params['accountId'];
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
        if(isset($files['applyUploadPath'])) {
            $ext = $files['applyUploadPath']->getClientOriginalExtension();
            $filename = $record->id. "_apply.$ext";
            $record->applyUploadPath = $path. $filename;
            $record->save();
            $files['applyUploadPath']->move($root. $path, $filename);
        }
        if(isset($files['proofOfProperty'])) {
            $ext = $files['proofOfProperty']->getClientOriginalExtension();
            $filename = $record->id. "_property.$ext";
            $record->proofOfProperty = $path. $filename;
            $record->save();
            $files['proofOfProperty']->move($root. $path, $filename);
        }
        if(isset($files['otherDoc'][0])) {
            $ext = $files['otherDoc'][0]->getClientOriginalExtension();
            $filename = $record->id. "_other.$ext";
            $record->otherDoc = $path. $filename;
            $record->save();
            $files['otherDoc'][0]->move($root. $path, $filename);
        }
        if(isset($files['otherDoc'][1])) {
            $ext = $files['otherDoc'][1]->getClientOriginalExtension();
            $filename = $record->id. "_other2.$ext";
            $record->otherDoc2 = $path. $filename;
            $record->save();
            $files['otherDoc'][1]->move($root. $path, $filename);
        }
        if(isset($files['otherDoc'][2])) {
            $ext = $files['otherDoc'][2]->getClientOriginalExtension();
            $filename = $record->id. "_other3.$ext";
            $record->otherDoc3 = $path. $filename;
            $record->save();
            $files['otherDoc'][2]->move($root. $path, $filename);
        }
        if(isset($files['otherDoc'][3])) {
            $ext = $files['otherDoc'][3]->getClientOriginalExtension();
            $filename = $record->id. "_other4.$ext";
            $record->otherDoc4 = $path. $filename;
            $record->save();
            $files['otherDoc'][3]->move($root. $path, $filename);
        }
        if(isset($files['otherDoc'][4])) {
            $ext = $files['otherDoc'][4]->getClientOriginalExtension();
            $filename = $record->id. "_other5.$ext";
            $record->otherDoc5 = $path. $filename;
            $record->save();
            $files['otherDoc'][4]->move($root. $path, $filename);
        }
        if(isset($files['otherDoc'][5])) {
            $ext = $files['otherDoc'][5]->getClientOriginalExtension();
            $filename = $record->id. "_other6.$ext";
            $record->otherDoc6 = $path. $filename;
            $record->save();
            $files['otherDoc'][5]->move($root. $path, $filename);
        }

        $params['recordId'] = $record->id;
        $messageRepository = new MessageRepository();
        $messageRepository->recordAdd($params);
    }

    public function lists($params) {
        $nowPage = isset($params['nowPage']) ? (int) $params['nowPage'] : 1;
        $offset = isset($params['offset']) ? (int) $params['offset'] : 10;
        $startDate = date('Y-m-d 00:00:00', strtotime('-3 months'));

        $recordQuery = Record::orderBy('id', 'desc')
            ->skip(($nowPage-1) * $offset)
            ->take($offset);
        if(isset($params['checkStatus'])) {
            $recordQuery->where('checkStatus', '=', $params['checkStatus']);
        }
        if(isset($params['schedule'])) {
            $recordQuery->where('schedule', '=', $params['schedule']);
        }
        if(isset($params['startDate'])) {
            $startDate = $params['startDate']. ' 00:00:00';
        }
        $recordQuery->where('created_at', '>=', $startDate);
        if(isset($params['endDate'])) {
            $endDate = $params['endDate']. ' 23:59:59';
            $recordQuery->where('created_at', '<=', $endDate);
        }
        if(isset($params['keyword'])) {
            $recordQuery->where(function($query) use ($params) {
                $query->orWhere('applicant', 'like', '%'. $params['keyword']. '%');
                $query->orWhere('CustGID', 'like', '%'. $params['keyword']. '%');
                $query->orWhere('productName', 'like', '%'. $params['keyword']. '%');
            });
        }
        if(isset($params['accountId'])) {
            $recordQuery->where('accountId', '=', $params['accountId']);
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
        if(isset($params['accountId'])) {
            $recordQuery->where('accountId', '=', $params['accountId']);
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
            $record->periods = isset($row[11]) ? $row[11] : 0;
            $record->periodAmount = isset($row[12]) ? $row[12] : 0;
            $record->content = isset($row[13]) ? $row[13] : '';
            //$record->grantDate = $row[23];
            $record->grantAmount = isset($row[16]) ? (int) $row[16] : 0;
            $record->liense = isset($row[20]) ? $row[20] : '';
            $record->productName = isset($row[24]) ? $row[24] : '';
            $record->CustGID = isset($row[25]) ? $row[25] : '';
            $record->updated_at = date('Y-m-d H:i:s');

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
                '核准',
                '已撥款',
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
            $record->periods = isset($row[11]) ? $row[11] : 0;
            $record->periodAmount = isset($row[12]) ? $row[12] : 0;
            $record->content = isset($row[13]) ? $row[13] : '';
            $record->schedule = isset($row[14]) ? $row[14] : '';
            //$record->grantDate = $row[23];
            $record->grantAmount = isset($row[16]) ? (int) $row[16] : 0;
            $record->liense = isset($row[20]) ? $row[20] : '';
            $record->productName = isset($row[24]) ? $row[24] : '';
            $record->CustGID = isset($row[25]) ? $row[25] : '';
            $record->created_at = date('Y-m-d H:i:s');
            $record->updated_at = date('Y-m-d H:i:s');
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
        $record->updated_at = date('Y-m-d H:i:s');


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
        if(isset($files['applyUploadPath'])) {
            if(trim($record->applyUploadPath) == '') {
                $ext = $files['applyUploadPath']->getClientOriginalExtension();
                $filename = $record->id. "_apply.$ext";
                $record->applyUploadPath = $path. $filename;
                $record->save();
            } else {
                $splitArr = preg_split("/\//", $record->applyUploadPath);
                $path = $splitArr[0]. "/". $splitArr[1]. "/". $splitArr[2]. "/";
                $filename = $splitArr[3];
            }
            $files['applyUploadPath']->move($root. $path, $filename);
        }
        if(isset($files['proofOfProperty'])) {
            if(trim($record->proofOfProperty) == '') {
                $ext = $files['proofOfProperty']->getClientOriginalExtension();
                $filename = $record->id. "_property.$ext";
                $record->proofOfProperty = $path. $filename;
                $record->save();
            } else {
                $splitArr = preg_split("/\//", $record->proofOfProperty);
                $path = $splitArr[0]. "/". $splitArr[1]. "/". $splitArr[2]. "/";
                $filename = $splitArr[3];
            }
            $files['proofOfProperty']->move($root. $path, $filename);
        }
        if(isset($files['otherDoc'][0])) {
            if(trim($record->otherDoc) == '') {
                $ext = $files['otherDoc'][0]->getClientOriginalExtension();
                $filename = $record->id. "_other.$ext";
                $record->otherDoc = $path. $filename;
                $record->save();
            } else {
                $splitArr = preg_split("/\//", $record->otherDoc);
                $path = $splitArr[0]. "/". $splitArr[1]. "/". $splitArr[2]. "/";
                $filename = $splitArr[3];
            }
            $files['otherDoc'][0]->move($root. $path, $filename);
        }
        if(isset($files['otherDoc'][1])) {
            if(trim($record->otherDoc2) == '') {
                $ext = $files['otherDoc'][1]->getClientOriginalExtension();
                $filename = $record->id. "_other2.$ext";
                $record->otherDoc2 = $path. $filename;
                $record->save();
            } else {
                $splitArr = preg_split("/\//", $record->otherDoc2);
                $path = $splitArr[0]. "/". $splitArr[1]. "/". $splitArr[2]. "/";
                $filename = $splitArr[3];
            }
            $files['otherDoc'][1]->move($root. $path, $filename);
        }
        if(isset($files['otherDoc'][2])) {
            if(trim($record->otherDoc3) == '') {
                $ext = $files['otherDoc'][2]->getClientOriginalExtension();
                $filename = $record->id. "_other3.$ext";
                $record->otherDoc3 = $path. $filename;
                $record->save();
            } else {
                $splitArr = preg_split("/\//", $record->otherDoc3);
                $path = $splitArr[0]. "/". $splitArr[1]. "/". $splitArr[2]. "/";
                $filename = $splitArr[3];
            }
            $files['otherDoc'][2]->move($root. $path, $filename);
        }
        if(isset($files['otherDoc'][3])) {
            if(trim($record->otherDoc4) == '') {
                $ext = $files['otherDoc'][3]->getClientOriginalExtension();
                $filename = $record->id. "_other4.$ext";
                $record->otherDoc4 = $path. $filename;
                $record->save();
            } else {
                $splitArr = preg_split("/\//", $record->otherDoc4);
                $path = $splitArr[0]. "/". $splitArr[1]. "/". $splitArr[2]. "/";
                $filename = $splitArr[3];
            }
            $files['otherDoc'][3]->move($root. $path, $filename);
        }
        if(isset($files['otherDoc'][4])) {
            if(trim($record->otherDoc5) == '') {
                $ext = $files['otherDoc'][4]->getClientOriginalExtension();
                $filename = $record->id. "_other5.$ext";
                $record->otherDoc5 = $path. $filename;
                $record->save();
            } else {
                $splitArr = preg_split("/\//", $record->otherDoc5);
                $path = $splitArr[0]. "/". $splitArr[1]. "/". $splitArr[2]. "/";
                $filename = $splitArr[3];
            }
            $files['otherDoc'][4]->move($root. $path, $filename);
        }
        if(isset($files['otherDoc'][5])) {
            if(trim($record->otherDoc6) == '') {
                $ext = $files['otherDoc'][5]->getClientOriginalExtension();
                $filename = $record->id. "_other6.$ext";
                $record->otherDoc6 = $path. $filename;
                $record->save();
            } else {
                $splitArr = preg_split("/\//", $record->otherDoc6);
                $path = $splitArr[0]. "/". $splitArr[1]. "/". $splitArr[2]. "/";
                $filename = $splitArr[3];
            }
            $files['otherDoc'][5]->move($root. $path, $filename);
        }
    }

    public function del($id) {
        $record = Record::where('id', '=', $id)
            ->first();
        if(isset($record->id) == false) {
            throw new Exception('案件不存在');
        }
        $record->delete();
    }

    public function cancel($id, $accountId) {
        $record = Record::where('id', '=', $id)
            ->where('accountId', '=', $accountId)
            ->first();
        if(isset($record->id) == false) {
            throw new Exception('案件不存在');
        }
        $record->checkStatus = '取消申辦';
        $record->save();
    }

    public function updateFileById($id, $files = []) {
        $record = Record::where('id', '=', $id)
            ->first();
        if(isset($record->id) == false) {
            throw new Exception('案件不存在');
        }

        $notify = [
            'CustGIDPicture1' => false,
            'CustGIDPicture2' => false,
            'applyUploadPath' => false,
            'proofOfProperty' => false,
            'otherDoc' => false,
            'otherDoc2' => false,
            'otherDoc3' => false,
            'otherDoc4' => false,
            'otherDoc5' => false,
            'otherDoc6' => false,
        ];

        $record->updated_at = date('Y-m-d H:i:s');

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
            $notify['CustGIDPicture1'] = true;
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
            $notify['CustGIDPicture2'] = true;
        }
        if(isset($files['applyUploadPath'])) {
            if(trim($record->applyUploadPath) == '') {
                $ext = $files['applyUploadPath']->getClientOriginalExtension();
                $filename = $record->id. "_apply.$ext";
                $record->applyUploadPath = $path. $filename;
                $record->save();
            } else {
                $splitArr = preg_split("/\//", $record->applyUploadPath);
                $path = $splitArr[0]. "/". $splitArr[1]. "/". $splitArr[2]. "/";
                $filename = $splitArr[3];
            }
            $files['applyUploadPath']->move($root. $path, $filename);
            $notify['applyUploadPath'] = true;
        }
        if(isset($files['proofOfProperty'])) {
            if(trim($record->proofOfProperty) == '') {
                $ext = $files['proofOfProperty']->getClientOriginalExtension();
                $filename = $record->id. "_property.$ext";
                $record->proofOfProperty = $path. $filename;
                $record->save();
            } else {
                $splitArr = preg_split("/\//", $record->proofOfProperty);
                $path = $splitArr[0]. "/". $splitArr[1]. "/". $splitArr[2]. "/";
                $filename = $splitArr[3];
            }
            $files['proofOfProperty']->move($root. $path, $filename);
            $notify['proofOfProperty'] = true;
        }
        if(isset($files['otherDoc'][0])) {
            if(trim($record->otherDoc) == '') {
                $ext = $files['otherDoc'][0]->getClientOriginalExtension();
                $filename = $record->id. "_other.$ext";
                $record->otherDoc = $path. $filename;
                $record->save();
            } else {
                $splitArr = preg_split("/\//", $record->otherDoc);
                $path = $splitArr[0]. "/". $splitArr[1]. "/". $splitArr[2]. "/";
                $filename = $splitArr[3];
            }
            $files['otherDoc'][0]->move($root. $path, $filename);
            $notify['otherDoc'] = true;
        }
        if(isset($files['otherDoc'][1])) {
            if(trim($record->otherDoc2) == '') {
                $ext = $files['otherDoc'][1]->getClientOriginalExtension();
                $filename = $record->id. "_other2.$ext";
                $record->otherDoc2 = $path. $filename;
                $record->save();
            } else {
                $splitArr = preg_split("/\//", $record->otherDoc2);
                $path = $splitArr[0]. "/". $splitArr[1]. "/". $splitArr[2]. "/";
                $filename = $splitArr[3];
            }
            $files['otherDoc'][1]->move($root. $path, $filename);
            $notify['otherDoc2'] = true;
        }
        if(isset($files['otherDoc'][2])) {
            if(trim($record->otherDoc3) == '') {
                $ext = $files['otherDoc'][2]->getClientOriginalExtension();
                $filename = $record->id. "_other3.$ext";
                $record->otherDoc3 = $path. $filename;
                $record->save();
            } else {
                $splitArr = preg_split("/\//", $record->otherDoc3);
                $path = $splitArr[0]. "/". $splitArr[1]. "/". $splitArr[2]. "/";
                $filename = $splitArr[3];
            }
            $files['otherDoc'][2]->move($root. $path, $filename);
            $notify['otherDoc3'] = true;
        }
        if(isset($files['otherDoc'][3])) {
            if(trim($record->otherDoc4) == '') {
                $ext = $files['otherDoc'][3]->getClientOriginalExtension();
                $filename = $record->id. "_other4.$ext";
                $record->otherDoc4 = $path. $filename;
                $record->save();
            } else {
                $splitArr = preg_split("/\//", $record->otherDoc4);
                $path = $splitArr[0]. "/". $splitArr[1]. "/". $splitArr[2]. "/";
                $filename = $splitArr[3];
            }
            $files['otherDoc'][3]->move($root. $path, $filename);
            $notify['otherDoc4'] = true;
        }
        if(isset($files['otherDoc'][4])) {
            if(trim($record->otherDoc5) == '') {
                $ext = $files['otherDoc'][4]->getClientOriginalExtension();
                $filename = $record->id. "_other5.$ext";
                $record->otherDoc5 = $path. $filename;
                $record->save();
            } else {
                $splitArr = preg_split("/\//", $record->otherDoc5);
                $path = $splitArr[0]. "/". $splitArr[1]. "/". $splitArr[2]. "/";
                $filename = $splitArr[3];
            }
            $files['otherDoc'][4]->move($root. $path, $filename);
            $notify['otherDoc5'] = true;
        }
        if(isset($files['otherDoc'][5])) {
            if(trim($record->otherDoc6) == '') {
                $ext = $files['otherDoc'][5]->getClientOriginalExtension();
                $filename = $record->id. "_other6.$ext";
                $record->otherDoc6 = $path. $filename;
                $record->save();
            } else {
                $splitArr = preg_split("/\//", $record->otherDoc6);
                $path = $splitArr[0]. "/". $splitArr[1]. "/". $splitArr[2]. "/";
                $filename = $splitArr[3];
            }
            $files['otherDoc'][5]->move($root. $path, $filename);
            $notify['otherDoc6'] = true;
        }
        $isNotify = false;
        foreach($notify as $item) {
            if($item == true)
                $isNotify = true;
        }
        if($isNotify) {
            $messageRepository = new MessageRepository();
            $messageRepository->additionalNotify($id, $notify);
        }
    }
}
