<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\RecordRepository;
use Session;
use Exception;

class ApplicationController extends Controller
{
    public function create(Request $request) {
        $account = Session::get('account');
        $res = [
            'status' => true,
            'message' => '',
        ];

        $validate = Validator::make($request->all(), [
            //'applyAmount' => 'required',
            'applicant' => 'required',
            'CustGID' => 'required',
            'CustGIDPicture1' => 'required',
            'CustGIDPicture2' => 'required',
            'applyUploadPath' => 'required',
        ]);

        if($validate->fails()) {
            $res['status'] = false;
            $res['message'] = $validate->errors();
            return response()->json($res, 200);
        }
        $params = $request->all();
        $files = [];
        if($request->hasFile('CustGIDPicture1'))
            $files['CustGIDPicture1'] = $request->file('CustGIDPicture1');
        if($request->hasFile('CustGIDPicture2'))
            $files['CustGIDPicture2'] = $request->file('CustGIDPicture2');
        if($request->hasFile('applyUploadPath'))
            $files['applyUploadPath'] = $request->file('applyUploadPath');
        if($request->hasFile('proofOfProperty'))
            $files['proofOfProperty'] = $request->file('proofOfProperty');
        if($request->hasFile('otherDoc'))
            $files['otherDoc'] = $request->file('otherDoc');

        $params['accountId'] = $account->id;
        try {
            $recordRepository = new RecordRepository();
            $recordRepository->create($params, $files);
        } catch (Exception $e) {
            $res['status'] = false;
            $res['message'] = $e->getMessage();
        }
        //$res['params'] = $request->all();
        $res['message'] = 'success';

        return response()->json($res);
    }

    public function cancelPage(Request $request) {
        return view('account.application.cancel');
    }

    public function cancel(Request $request) {
        $account = Session::get('account');
        $res = [
            'status' => true,
            'message' => 'cancel success',
        ];

        $validate = Validator::make($request->all(), [
            'recordId' => 'required',
        ]);

        if($validate->fails()) {
            $res['status'] = false;
            $res['message'] = $validate->errors();
            return response()->json($res, 200);
        }
        $params = $request->all();

        try {
            $id = isset($params['recordId']) ? $params['recordId'] : 0;
            $recordRepository = new RecordRepository();
            $recordRepository->cancel($id, $account->id);
        } catch (Exception $e) {
            $res['status'] = false;
            $res['message'] = $e->getMessage();
        }

        return response()->json($res);
    }

    public function updatePage(Request $request) {
        return view('account.application.update');
    }

    public function update(Request $request) {
        $account = Session::get('account');
        $res = [
            'status' => true,
            'message' => 'success',
        ];

        $validate = Validator::make($request->all(), [
            'recordId' => 'required',
        ]);

        if($validate->fails()) {
            $res['status'] = false;
            $res['message'] = $validate->errors();
            return response()->json($res, 200);
        }

        $params = $request->all();
        $id = $params['recordId'];

        if($request->hasFile('CustGIDPicture1'))
            $files['CustGIDPicture1'] = $request->file('CustGIDPicture1');
        if($request->hasFile('CustGIDPicture2'))
            $files['CustGIDPicture2'] = $request->file('CustGIDPicture2');
        if($request->hasFile('applyUploadPath'))
            $files['applyUploadPath'] = $request->file('applyUploadPath');
        if($request->hasFile('proofOfProperty'))
            $files['proofOfProperty'] = $request->file('proofOfProperty');
        if($request->hasFile('otherDoc'))
            $files['otherDoc'] = $request->file('otherDoc');
        try {
            $recordRepository = new RecordRepository();
            $recordRepository->updateFileById($id, $files);
        } catch (Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return response()->json($res);
    }
}
