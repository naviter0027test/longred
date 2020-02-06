<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use \App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Repositories\RecordRepository;
use App\Repositories\MessageRepository;
use App\Repositories\AccountRepository;
use Session;
use Exception;

class MessageController extends Controller
{

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

        $admin = Session::get('admin');
        $params['creator'] = $admin->id;
        $params['type'] = 3; //案件回覆
        $params['isAsk'] = 2; //案件管理者留言
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

    public function getByRecordId(Request $request, $id) {
        //$params = $request->all();
        $params = ['recordId' => $id];

        $admin = Session::get('admin');
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
