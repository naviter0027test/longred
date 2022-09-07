<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->id = 1;
        $admin->account = 'admin';
        $admin->password = md5('123456');
        $admin->active = 1;
        $admin->isSuper = 1;
        $admin->name = '管理者';
        $admin->phone = '0912342134';
        $admin->email = 'adm123@test.com.tw';
        $admin->created_at = '2020-09-01 18:00:00';
        $admin->updated_at = '2020-09-01 18:00:00';
        $admin->save();
    }
}
