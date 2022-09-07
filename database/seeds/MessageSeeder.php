<?php

use Illuminate\Database\Seeder;
use App\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1;$i <= 15;++$i) {
            $message = new Message();
            $message->id = $i;
            $message->title = "news title$i";
            $message->content = "news content$i";
            $message->type = 1;
            $message->created_at = "2020-09-05 00:00:00";
            $message->updated_at = "2020-09-05 00:00:00";
            $message->save();
        }
        for($i = 16;$i <= 30;++$i) {
            $message = new Message();
            $message->id = $i;
            $message->title = "ann title$i";
            $message->content = "ann content$i";
            $message->type = 2;
            $message->created_at = "2020-09-05 00:00:00";
            $message->updated_at = "2020-09-05 00:00:00";
            $message->save();
        }
    }
}
