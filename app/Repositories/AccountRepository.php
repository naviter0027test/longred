<?php

namespace App\Repositories;

use App\Account;
use Exception;

class AccountRepository
{
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
}

