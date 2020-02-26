<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\RecordRepository;
use App\Repositories\AccountRepository;
use Session;
use Exception;

class AccountController extends Controller
{
    public function loginPage(Request $request) {
        return view('account.login');
    }

    public function login(Request $request) {
        $result = [
            'status' => false,
            'msg' => 'login failure',
        ];
        $params = $request->all();
        $params['account'] = isset($params['account']) ? $params['account'] : '';
        $params['password'] = isset($params['password']) ? $params['password'] : '';
        $accountRepository = new AccountRepository();
        $account = $accountRepository->checkPassword($params);
        if($account != false) {
            Session::put('account', $account);
            $result = [
                'status' => true,
                'msg' => 'login success',
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

    public function forgetPage(Request $request) {
        return view('account.forget');
    }

    public function forget(Request $request) {
        $res = [
            'status' => true,
            'msg' => '發送新密碼至您的信箱'
        ];
        $params = $request->all();
        $email = isset($params['email']) ? $params['email'] : '';
        $accountRepository = new AccountRepository();
        try {
            $newPass = $accountRepository->sendNewPassword($email);
        } catch (Exception $e) {
            $res['status'] = false;
            $res['message'] = $e->getMessage();
        }

        return response()->json($res);
    }

    public function appleTokenSetPage(Request $request) {
        return view('account.apple.set');
    }

    public function appleTokenGetPage(Request $request) {
        return view('account.apple.get');
    }

    public function appleTokenSet(Request $request) {
        $account = Session::get('account');
        $params = $request->all();
        $appleToken = isset($params['appleToken']) ? $params['appleToken'] : '';
        $res = [
            'status' => true,
            'msg' => '設定成功'
        ];
        try {
            $accountRepository = new AccountRepository();
            $accountRepository->appleTokenSet($account->id, $appleToken);
        } catch (Exception $e) {
            $res['status'] = false;
            $res['message'] = $e->getMessage();
        }
        return response()->json($res);
    }

    public function appleTokenGet(Request $request) {
        $account = Session::get('account');
        $accountRepository = new AccountRepository();
        $res = [
            'status' => true,
            'msg' => '取得成功'
        ];
        try {
            $accountRepository = new AccountRepository();
            $res['appleToken'] = $accountRepository->appleTokenGet($account->id);
        } catch (Exception $e) {
            $res['status'] = false;
            $res['message'] = $e->getMessage();
        }
        return response()->json($res);
    }
}
