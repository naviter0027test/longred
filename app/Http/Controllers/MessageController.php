<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\RecordRepository;
use App\Repositories\MessageRepository;
use App\Repositories\AccountRepository;
use Session;
use Exception;

class MessageController extends Controller
{
    public function sendPage(Request $request) {
        return view('account.message.send');
    }

    public function send(Request $request) {
        $params = $request->all();
        $validate = Validator::make($request->all(), [
            'content' => 'required',
            'recordId' => 'required|integer',
        ]);

        if($validate->fails()) {
            $res['status'] = false;
            $res['message'] = $validate->errors();
            return response()->json($res, 200);
        }

        $account = Session::get('account');
        $params['who'] = $account->id;
        $params['type'] = 6; //案件使用者留言
        $params['isAsk'] = 1; //案件使用者留言
        $result = [
            'result' => true,
            'msg' => 'success',
        ];
        try {
            $messageRepository = new MessageRepository();
            $messageRepository->send($params);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return json_encode($result);
    }

    public function getByRecordIdPage(Request $request) {
        return view('account.message.get');
    }

    public function getByRecordId(Request $request) {
        $params = $request->all();
        $validate = Validator::make($request->all(), [
            'recordId' => 'required|integer',
        ]);

        if($validate->fails()) {
            $res['status'] = false;
            $res['message'] = $validate->errors();
            return response()->json($res, 200);
        }

        $account = Session::get('account');
        $result = [
            'result' => true,
            'msg' => 'success',
        ];
        try {
            $messageRepository = new MessageRepository();
            $result['data'] = $messageRepository->getByRecordId($params);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return json_encode($result);
    }
}
