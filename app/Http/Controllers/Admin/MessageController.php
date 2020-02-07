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

    public function getNews(Request $request) {
        $admin = Session::get('admin');
        $params = $request->all();
        $nowPage = isset($params['nowPage']) ? $params['nowPage'] : 1;
        $offset =  isset($params['offset']) ? $params['offset'] : 10;
        $result = [
            'result' => true,
            'msg' => 'success',
        ];
        try {
            $messageRepository = new MessageRepository();
            $result['news'] = $messageRepository->getNews($params);
            $result['amount'] = $messageRepository->getNewsAmount($params);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin.news.index', ['adm' => $admin, 'result' => $result, 'offset' => $offset, 'nowPage' => $nowPage]);
    }

    public function createNewPage(Request $request) {
        $admin = Session::get('admin');
        $params = $request->all();
        return view('admin.news.create', ['adm' => $admin]);
    }

    public function createNew(Request $request) {
        $admin = Session::get('admin');
        $params = $request->all();
        $result = [
            'result' => true,
            'msg' => '新增成功',
        ];
        try {
            $messageRepository = new MessageRepository();
            $messageRepository->createNew($params);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin.proccessResult', ['adm' => $admin, 'result' => $result]);
    }

    public function editNewPage(Request $request, $id) {
        $admin = Session::get('admin');
        $result = [
            'result' => true,
            'msg' => 'success',
        ];
        try {
            $messageRepository = new MessageRepository();
            $result['news'] = $messageRepository->getNewsById($id);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin.news.edit', ['adm' => $admin, 'result' => $result]);
    }

    public function editNew(Request $request, $id) {
        $admin = Session::get('admin');
        $params = $request->all();
        $result = [
            'result' => true,
            'msg' => '編輯成功',
        ];
        try {
            $messageRepository = new MessageRepository();
            $result['account'] = $messageRepository->editNew($id, $params);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin.proccessResult', ['adm' => $admin, 'result' => $result]);
    }

    public function removeNew(Request $request, $id) {
        $admin = Session::get('admin');
        $result = [
            'result' => true,
            'msg' => '刪除成功',
        ];
        try {
            $messageRepository = new MessageRepository();
            $messageRepository->delNewById($id);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin.proccessResult', ['adm' => $admin, 'result' => $result]);
    }

    public function getAnnouncement(Request $request) {
        $admin = Session::get('admin');
        $params = $request->all();
        $nowPage = isset($params['nowPage']) ? $params['nowPage'] : 1;
        $offset =  isset($params['offset']) ? $params['offset'] : 10;
        $result = [
            'result' => true,
            'msg' => 'success',
        ];
        try {
            $messageRepository = new MessageRepository();
            $result['announcements'] = $messageRepository->getAnnouncement($params);
            $result['amount'] = $messageRepository->getAnnouncementAmount($params);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin.announcement.index', ['adm' => $admin, 'result' => $result, 'offset' => $offset, 'nowPage' => $nowPage]);
    }

    public function createAnnouncementPage(Request $request) {
        $admin = Session::get('admin');
        $params = $request->all();
        return view('admin.announcement.create', ['adm' => $admin]);
    }

    public function createAnnouncement(Request $request) {
        $admin = Session::get('admin');
        $params = $request->all();
        $result = [
            'result' => true,
            'msg' => '新增成功',
        ];
        try {
            $messageRepository = new MessageRepository();
            $messageRepository->createAnnouncement($params);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin.proccessResult', ['adm' => $admin, 'result' => $result]);
    }

    public function editAnnouncementPage(Request $request, $id) {
        $admin = Session::get('admin');
        $result = [
            'result' => true,
            'msg' => 'success',
        ];
        try {
            $messageRepository = new MessageRepository();
            $result['announcement'] = $messageRepository->getAnnouncementById($id);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin.announcement.edit', ['adm' => $admin, 'result' => $result]);
    }

    public function editAnnouncement(Request $request, $id) {
        $admin = Session::get('admin');
        $params = $request->all();
        $result = [
            'result' => true,
            'msg' => '編輯成功',
        ];
        try {
            $messageRepository = new MessageRepository();
            $result['account'] = $messageRepository->editAnnouncement($id, $params);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin.proccessResult', ['adm' => $admin, 'result' => $result]);
    }

    public function removeAnnouncement(Request $request, $id) {
        $admin = Session::get('admin');
        $result = [
            'result' => true,
            'msg' => '刪除成功',
        ];
        try {
            $messageRepository = new MessageRepository();
            $messageRepository->delAnnouncementById($id);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin.proccessResult', ['adm' => $admin, 'result' => $result]);
    }
}
