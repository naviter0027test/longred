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
        $params = $request->all();
        $params['account'] = isset($params['account']) ? $params['account'] : '';
        $params['password'] = isset($params['password']) ? $params['password'] : '';
        $accountRepository = new AccountRepository();
        $account = $accountRepository->checkPassword($params);
        if($account != false) {
            Session::put('account', $account);
            return redirect('/application/create');
        }
        return view('account.login');
    }

    public function logout(Request $request) {
        Session::flush();
        return redirect('/account/login');
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
        return $result;
    }

    public function getMyData(Request $request) {
    }
}
