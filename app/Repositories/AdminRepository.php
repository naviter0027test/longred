<?php

namespace App\Repositories;

use App\Admin;
use Exception;

class AdminRepository
{
    public function checkPassword($params) {
        $adm = Admin::where('account', '=', $params['account'])
            ->where('password', '=', md5($params['password']))
            ->first();
        if(isset($adm->id)) {
            return $adm;
        }
        return false;
    }

    public function updatePassword($params) {
        $adm = Admin::where('account', '=', $params['account'])
            ->where('password', '=', md5($params['passwordOld']))
            ->first();
        if(isset($adm->id) == false) {
            throw new Exception('舊密碼輸入錯誤');
        }
        $adm->password = md5($params['password']);
        $adm->save();
    }
}
