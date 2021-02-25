<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\RecordRepository;
use App\Repositories\AccountRepository;
use App\Repositories\AndroidRepository;
use Session;
use Exception;

class FrontController extends Controller
{
    public function login(Request $request) {
        return view('front.login');
    }

    public function home(Request $request) {
        return view('front.home');
    }

    public function create(Request $request) {
        return view('front.create');
    }
}
