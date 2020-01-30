<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\RecordRepository;
use App\Repositories\AccountRepository;
use Session;

class AccountController extends Controller
{
    public function loginPage(Request $request) {
        return view('account.login');
    }

    public function login(Request $request) {
        $result = [
            'status' => true,
            'msg' => 'login success',
        ];
        $params = $request->all();
        $params['account'] = isset($params['account']) ? $params['account'] : '';
        $params['password'] = isset($params['password']) ? $params['password'] : '';
        $accountRepository = new AccountRepository();
        $account = $accountRepository->checkPassword($params);
        if($account != false) {
            Session::put('account', $account);
            $result = [
                'status' => false,
                'msg' => 'login failure',
            ];
            return json_encode($result);
        }
        return json_encode($result);
    }

    public function logout(Request $request) {
        Session::flush();
        $result = [
            'status' => true,
            'msg' => 'logout success',
        ];
        return json_encode($result);
    }

    public function isLogin(Request $request) {
        $result = [
            'status' => true,
            'msg' => 'has login'
        ];

        if(Session::has('account') == false) {
            $result = [
                'status' => false,
                'msg' => 'not login'
            ];
        }
        return json_encode($result);
    }

    public function getMyData(Request $request) {
    }
}
