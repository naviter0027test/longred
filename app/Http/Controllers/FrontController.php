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
    public function forget(Request $request) {
        return view('front.forget');
    }

    public function login(Request $request) {
        return view('front.login');
    }

    public function home(Request $request) {
        return view('front.home');
    }

    public function create(Request $request) {
        return view('front.create');
    }

    public function search(Request $request) {
        $data = [
            'checkStatus' => '',
        ];
        return view('front.search', ['data' => $data]);
    }

    public function appropriation(Request $request) {
        return view('front.appropriation');
    }

    public function process(Request $request) {
        $data = [
            'checkStatus' => '處理中',
        ];
        return view('front.search', ['data' => $data]);
    }

    public function wait(Request $request) {
        $data = [
            'checkStatus' => '待核准',
        ];
        return view('front.search', ['data' => $data]);
    }

    public function agree(Request $request) {
        $data = [
            'checkStatus' => '核准',
        ];
        return view('front.search', ['data' => $data]);
    }

    public function degree(Request $request) {
        $data = [
            'checkStatus' => '婉拒',
        ];
        return view('front.search', ['data' => $data]);
    }

    public function cancel(Request $request) {
        $data = [
            'checkStatus' => '取消申辦',
        ];
        return view('front.search', ['data' => $data]);
    }

    public function news(Request $request) {
        return view('front.news');
    }

    public function newsItem(Request $request, $id) {
        return view('front.news-item');
    }

    public function modify(Request $request) {
        return view('front.modify');
    }

    public function message(Request $request) {
        return view('front.message');
    }

    public function record(Request $request) {
        return view('front.record');
    }
}
