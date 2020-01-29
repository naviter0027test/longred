<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use \App\Http\Controllers\Controller;
use App\Repositories\AccountRepository;
use Session;
use Exception;

class AccountController extends Controller
{
    public function lists(Request $request) {
        $admin = Session::get('admin');
        $params = $request->all();
        $keyword = isset($params['keyword']) ? $params['keyword'] : '';
        $nowPage = isset($params['nowPage']) ? $params['nowPage'] : 1;
        $offset =  isset($params['offset']) ? $params['offset'] : 10;
        $result = [
            'result' => true,
            'msg' => 'success',
        ];
        try {
            $accountRepository = new AccountRepository();
            $result['accounts'] = $accountRepository->lists($params);
            $result['amount'] = $accountRepository->listsAmount($params);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin.account.index', ['adm' => $admin, 'result' => $result, 'offset' => $offset, 'nowPage' => $nowPage, 'keyword' => $keyword]);
    }

    public function createPage(Request $request) {
        $admin = Session::get('admin');
        $params = $request->all();
        return view('admin.account.create', ['adm' => $admin]);
    }

    public function create(Request $request) {
        $admin = Session::get('admin');
        $params = $request->all();
        $result = [
            'result' => true,
            'msg' => '新增成功',
        ];
        try {
            $accountRepository = new AccountRepository();
            $accountRepository->create($params);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin.account.createResult', ['adm' => $admin, 'result' => $result]);
    }

    public function edit(Request $request, $id) {
        $admin = Session::get('admin');
        $result = [
            'result' => true,
            'msg' => 'success',
        ];
        try {
            $accountRepository = new AccountRepository();
            $result['account'] = $accountRepository->getById($id);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin.account.edit', ['adm' => $admin, 'result' => $result]);
    }

    public function update(Request $request, $id) {
        $admin = Session::get('admin');
        $params = $request->all();
        $result = [
            'result' => true,
            'msg' => '編輯成功',
        ];
        try {
            $accountRepository = new AccountRepository();
            $result['account'] = $accountRepository->update($id, $params);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin.account.createResult', ['adm' => $admin, 'result' => $result]);
    }

    public function remove(Request $request, $id) {
        $admin = Session::get('admin');
        $result = [
            'result' => true,
            'msg' => '刪除成功',
        ];
        try {
            $accountRepository = new AccountRepository();
            $accountRepository->delById($id);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin.account.createResult', ['adm' => $admin, 'result' => $result]);
    }
}
