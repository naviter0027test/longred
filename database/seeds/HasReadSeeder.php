<?php

use Illuminate\Database\Seeder;
use App\HasRead;

class HasReadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1;$i <= 3;++$i) {
            $hasRead = new HasRead();
            $hasRead->id = $i;
            $hasRead->accountId = 1;
            $hasRead->messageId = $i;
            $hasRead->isRead = 1;
            $hasRead->created_at = "2020-09-05 10:00:00";
            $hasRead->updated_at = "2020-09-05 10:00:00";
            $hasRead->save();
        }
    }
}
