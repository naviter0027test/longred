<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use \App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;
use Session;
use Exception;

class UserController extends Controller
{
    public function home(Request $request) {
        $admin = Session::get('admin');
        return view('admin.home', ['adm' => $admin]);
    }

    public function loginPage(Request $request) {
        return view('admin.login');
    }

    public function passAdmin(Request $request) {
        $admin = Session::get('admin');
        return view('admin.setting.index', ['adm' => $admin]);
    }

    public function login(Request $request) {
        $params = $request->all();
        $params['account'] = isset($params['account']) ? $params['account'] : '';
        $params['password'] = isset($params['password']) ? $params['password'] : '';
        $adminRepository = new AdminRepository();
        $adm = $adminRepository->checkPassword($params);
        if($adm != false) {
            Session::put('admin', $adm);
            return redirect('/admin/home');
        }
        return view('admin.login');
    }

    public function logout(Request $request) {
        Session::flush();
        return redirect('/admin/login');
    }

    public function passUpdate(Request $request) {
        $admin = Session::get('admin');
        $params = $request->all();
        $params['account'] = $admin->account;
        $result = [
            'result' => true,
            'msg' => 'success',
        ];

        try {
            $adminRepository = new AdminRepository();
            $adminRepository->updatePassword($params);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('admin.proccessResult', ['adm' => $admin, 'result' => $result]);
    }
}
