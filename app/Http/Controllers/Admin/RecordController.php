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
        unset($params['nowPage']);
        return view('admin/record/index', ['adm' => $admin, 'result' => $result, 'offset' => $offset, 'nowPage' => $nowPage, 'params' => $params]);
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

    public function update(Request $request, $id) {
        $admin = Session::get('admin');
        $params = $request->all();
        $files = [];
        $result = [
            'result' => true,
            'msg' => 'success',
        ];
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
            $recordRepository->updateById($id, $params, $admin, $files);
        } catch (Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin.proccessResult', ['adm' => $admin, 'result' => $result]);
    }

    public function grant(Request $request) {
        $params = $request->all();
        $nowPage = isset($params['nowPage']) ? $params['nowPage'] : 1;
        $offset = isset($params['offset']) ? $params['offset'] : 10;
        $params['checkStatus'] = '核准';
        $admin = Session::get('admin');
        $result = [
            'result' => true,
            'msg' => 'success',
            'amount' => 0,
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
        unset($params['nowPage']);
        return view('admin/grant/index', ['adm' => $admin, 'result' => $result, 'offset' => $offset, 'nowPage' => $nowPage, 'params' => $params]);
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
            $result['rows'] = $recordRepository->import($file, $admin);
        }
        return view('admin/record/importResult', ['adm' => $admin, 'result' => $result]);
    }

    public function remove(Request $request, $id) {
        $admin = Session::get('admin');
        $files = [];
        $result = [
            'result' => true,
            'msg' => 'success',
        ];

        try {
            $recordRepository = new RecordRepository();
            $recordRepository->del($id);
        } catch (Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin.proccessResult', ['adm' => $admin, 'result' => $result]);
    }

    public function downloadAllImages(Request $request, $id) {
        $admin = Session::get('admin');
        $result = [
            'result' => true,
            'msg' => 'success',
        ];

        $files = '';
        try {
            $recordRepository = new RecordRepository();
            $zipArr = $recordRepository->downloadAllImages($id);
        } catch (Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }

        if($result['result'] == false)
            return view('admin.proccessResult', ['adm' => $admin, 'result' => $result]);

        $headers = array(
            'Content-Type: application/octet-stream',
        );
        return response()->download($zipArr['path'], $zipArr['name'], $headers);
    }

}
