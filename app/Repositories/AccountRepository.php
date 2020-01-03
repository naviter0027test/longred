<?php

namespace App\Repositories;

use App\Account;
use Exception;

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
}

