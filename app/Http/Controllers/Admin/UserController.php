<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use \App\Http\Controllers\Controller;
use Session;

class UserController extends Controller
{
    public function home(Request $request) {
        return view('admin.home');
    }

    public function loginPage(Request $request) {
        return view('admin.login');
    }

    public function passAdmin(Request $request) {
        return view('admin.setting');
    }

    public function login(Request $request) {
        return view('admin.login');
    }

    public function logout(Request $request) {
        Session::flush();
        return redirect('/admin/login');
    }

    public function passUpdate(Request $request) {
    }
}
