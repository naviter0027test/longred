<?php

use Illuminate\Database\Seeder;
use App\Account;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1;$i <= 20;++$i) {
            $account = new Account();
            $account->id = $i;
            $account->account = 'account'. $i;
            $account->password = md5('123456');
            $account->name = 'name'. $i;
            $account->email = "name$i@test.com.tw";
            $account->phone = '1234567'. $i;
            $account->area = 'area'. $i;
            $account->active = 1;
            $account->tokenMode = 2;
            $account->created_at = '2020-09-01 18:00:00';
            $account->updated_at = '2020-09-01 18:00:00';
            if($i == 11) {
                $account->appleToken = '1qaz2wsx';
                $account->tokenMode = 1;
            }
            $account->save();
        }
    }
}
