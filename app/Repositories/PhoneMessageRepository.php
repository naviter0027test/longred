<?php

namespace App\Repositories;

use App\Account;
use Exception;
use Config;

class PhoneMessageRepository
{
    public function pushNewsToAll($content = '') {
        //\Log::info(getcwd());
        $accounts = Account::where('phone', '<>', '')
            ->get();
        foreach($accounts as $account)
            if(trim($account->phone) != '')
                $this->push($account->phone, $content);
    }

    public function pushOne($accountId, $content = '') {
        $account = Account::where('phone', '<>', '')
            ->first();
        if(trim($account->phone) != '')
            $this->push($account->phone, $content);
        else
            \Log::info($account->id. ': apple token no data');
    }

    public function push($phone = '', $content = '') {
        if(trim($phone) == '')
            throw new Exception('phone not input');

        if(trim($content) == '')
            throw new Exception('content not input');
	if(trim(config('smsgo.username')) == '' || trim(config('smsgo.password')) == '') {
            throw new Exception('smsgo need username or password');
	}

	$toUrl = config('smsgo.url');

	$data = array();
        $data['username'] = config('smsgo.username');
        $data['password'] = config('smsgo.password');
	$data['dstaddr'] = $phone;
	$data['smbody'] = $content;

	$getString = http_build_query($data);

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "$toUrl?$getString");
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	$result = curl_exec($curl);
	\Log::info($result);
    }
}
