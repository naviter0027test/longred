<?php

namespace App\Repositories;

use App\Message;
use Exception;

class MessageRepository
{
    public function statusUpdate($recordId, $content, $creator) {
        //狀態變動的相關處理於此，比如寄信或一些通知
        $message = new Message();
        $message->content = $content;
        $message->type = 5;
        $message->recordId = $recordId;
        $message->creator = $creator;
        $message->save();
    }
}
