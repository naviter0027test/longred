<?php

namespace App\Repositories;

use App\Account;
use Exception;
use Config;

class AccountRepository
{
    public function checkPassword($params) {
        $adm = Account::where('account', '=', $params['account'])
            ->where('password', '=', md5($params['password']))
            ->first();
        if(isset($adm->id)) {
            return $adm;
        }
        return false;
    }

    public function lists($params) {
        $keyword = isset($params['keyword']) ? $params['keyword'] : '';
        $nowPage = isset($params['nowPage']) ? $params['nowPage'] : 1;
        $offset = isset($params['offset']) ? $params['offset'] : 10;
        $accounts = Account::where('name', 'like', "%$keyword%")
            ->orderBy('id', 'desc')
            ->skip(($nowPage-1) * $offset)
            ->take($offset)
            ->get();
        if(isset($accounts[0])) {
            return $accounts;
        }
        return [];
    }

    public function listsAmount($params) {
        $keyword = isset($params['keyword']) ? $params['keyword'] : '';
        $amount = Account::where('name', 'like', "%$keyword%")
            ->count();
        return $amount;
    }

    public function create($params) {
        $accountTmp = isset($params['account']) ? $params['account'] : '';
        $checkAccount = Account::where('account', '=', $accountTmp)
            ->first();
        if(isset($checkAccount->id))
            throw new Exception('帳號重複');
        $account = new Account();
        $account->account = $accountTmp;
        $account->password = isset($params['password']) ? md5($params['password']) : '';
        $account->name = isset($params['name']) ? $params['name'] : '';
        $account->email = isset($params['email']) ? $params['email'] : '';
        $account->phone = isset($params['phone']) ? $params['phone'] : '';
        $account->active = isset($params['active']) ? $params['active'] : 0;
        $account->save();
    }

    public function getById($id) {
        $account = Account::where('id', '=', $id)
            ->first();
        if(isset($account->id) == false)
            throw new Exception('帳號不存在');
        return $account;
    }

    public function update($id, $params) {
        $accountTmp = isset($params['account']) ? $params['account'] : '';
        $account = Account::where('id', '=', $id)
            ->first();
        $account->account = $accountTmp;
        if(isset($params['password']) && $params['password'] != '')
            $account->password = md5($params['password']);
        $account->name = isset($params['name']) ? $params['name'] : '';
        $account->email = isset($params['email']) ? $params['email'] : '';
        $account->phone = isset($params['phone']) ? $params['phone'] : '';
        $account->active = isset($params['active']) ? $params['active'] : 0;
        $account->save();
    }

    public function delById($id) {
        $account = Account::where('id', '=', $id)
            ->first();
        if(isset($account->id) == false)
            throw new Exception('帳號不存在');
        $account->delete();
    }

    public function sendNewPassword($email) {
        $email = trim($email);
        $account = Account::where('email', '=', $email)
            ->first();
        if(isset($account->id) == false)
            throw new Exception('帳號不存在');
        $newPassword = $this->newPass();
        \Mail::send('email.forget', ['password' => $newPassword, 'account' => $account], function($message) use ($account) {
            $fromAddr = Config::get('mail.from.address');
            $fromName = Config::get('mail.from.name');
            $testTitle = env('APP_ENV') == 'local' ? '[Test] ' : '';
            $message->from($fromAddr, $fromName);
            $message->to($account->email, $account->name)->subject("$testTitle 長鴻系統 - 忘記密碼 (系統發信，請勿回覆)");
        });
        $account->password = md5($newPassword);
        $account->save();
        return $newPassword;
    }

    public function newPass($len = 8) {
        $charArr = ['1','2','3','4','5','6','7','8','9','0','q','a','z','w','s','x','e','d','c','r','f','v','t','g','b','y','h','n','u','j','m','i','k','o','l','p'];
        $charArrLen = count($charArr);
        $newPass = '';
        for($i = 0; $i < $len; ++$i) {
            $newPass .= $charArr[rand(0, $charArrLen - 1)];
        }
        return $newPass;
    }
}

