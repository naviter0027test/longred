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

    //案件留言與回覆
    public function send($params) {
        //狀態變動的相關處理於此，比如寄信或一些通知
        $message = new Message();
        $message->content = isset($params['content']) ? $params['content'] : '';
        $message->type = isset($params['type']) ? $params['type'] : 0;
        if(isset($params['recordId']))
            $message->recordId = $params['recordId'];
        else
            throw new Exception('recordId is required');
        $message->isAsk = $params['isAsk'];
        $message->who = $params['who'];
        $message->save();
    }

    public function getByRecordId($params) {
        $msgQty = Message::whereIn('type', [3])
            ->where('recordId', '=', $params['recordId'])
            ->whereNotNull('isAsk');
        $messages = $msgQty->get();
        return $messages;
    }
}
