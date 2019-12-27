<?php

namespace App\Repositories;

use App\Admin;

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
}
