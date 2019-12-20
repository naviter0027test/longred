<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use \App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;
use App\Repositories\RecordRepository;
use Session;

class RecordController extends Controller
{
    public function index(Request $request) {
        $params = $request->all();
        $nowPage = isset($params['nowPage']) ? $params['nowPage'] : 1;
        $offset = isset($params['offset']) ? $params['offset'] : 10;
        $admin = Session::get('admin');
        $result = [
            'result' => true,
            'msg' => 'success',
        ];
        try {
            $recordRepository = new RecordRepository();
            $result['records'] = $recordRepository->lists($params);
            $result['amount'] = $recordRepository->listsAmount($params);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin/record/index', ['adm' => $admin, 'result' => $result, 'offset' => $offset, 'nowPage' => $nowPage]);
    }

    public function edit(Request $request, $id) {
        $admin = Session::get('admin');
        return view('admin/record/edit', ['adm' => $admin]);
    }

    public function grant(Request $request) {
        $params = $request->all();
        $nowPage = isset($params['nowPage']) ? $params['nowPage'] : 1;
        $offset = isset($params['offset']) ? $params['offset'] : 10;
        $params['schedule'] = '已撥款';
        $admin = Session::get('admin');
        $result = [
            'result' => true,
            'msg' => 'success',
        ];
        try {
            $recordRepository = new RecordRepository();
            $result['records'] = $recordRepository->lists($params);
            $result['amount'] = $recordRepository->listsAmount($params);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin/grant/index', ['adm' => $admin, 'result' => $result, 'offset' => $offset, 'nowPage' => $nowPage]);
    }
}
