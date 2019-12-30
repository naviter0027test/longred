<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use \App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;
use App\Repositories\RecordRepository;
use Session;
use Exception;

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
        $result = [
            'result' => true,
            'msg' => 'success',
        ];
        try {
            $recordRepository = new RecordRepository();
            $result['record'] = $recordRepository->getById($id);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin/record/edit', ['adm' => $admin, 'result' => $result]);
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

    public function import(Request $request) {
        $admin = Session::get('admin');
        $file = null;
        $result = [
            'rows' => [],
        ];
        if($request->hasFile('importCSV'))
            $file = $request->file('importCSV');
        if($file != null) {
            $recordRepository = new RecordRepository();
            $result['rows'] = $recordRepository->import($file);
        }
        return view('admin/record/importResult', ['adm' => $admin, 'result' => $result]);
    }
}
