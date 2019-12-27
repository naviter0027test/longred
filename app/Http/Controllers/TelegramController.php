<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\RecordRepository;

class TelegramController extends Controller
{
    public function test(Request $request) {
        return $request->all();
    }

    public function login(Request $request) {
        /*
        $ip = config('telegram.ip');
        $port = config('telegram.port');
        $url = "https://venus.web.telegram.org:80/api_test";
        $post = [
            'phone_number' => config('telegram.phone'),
            'api_id' => config('telegram.id'),
            'api_hash' => config('telegram.hash'),
            'settings' => 'auth.SentCode',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
         
        //強制轉為UTF-8
        curl_setopt($ch,CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=utf-8"));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post)); 
         
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
         */
        return ;
    }
}
