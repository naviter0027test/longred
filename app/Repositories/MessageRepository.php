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
        if(isset($params['who']))
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

    public function getNews($params) {
        $keyword = isset($params['keyword']) ? $params['keyword'] : '';
        $nowPage = isset($params['nowPage']) ? $params['nowPage'] : 1;
        $offset = isset($params['offset']) ? $params['offset'] : 10;
        $messages = Message::where('type', '=', 1)
            ->orderBy('id', 'desc')
            ->skip(($nowPage-1) * $offset)
            ->take($offset)
            ->get();
        if(isset($messages[0])) {
            return $messages;
        }
        return [];
    }

    public function getNewsAmount($params) {
        $keyword = isset($params['keyword']) ? $params['keyword'] : '';
        $amount = Message::where('type', '=', 1)
            ->count();
        return $amount;
    }

    public function createNew($params) {
        $message = new Message();
        $message->type = 1;
        $message->title = isset($params['title']) ? $params['title'] : '';
        $message->content = $params['content'];
        $message->save();
    }

    public function getNewsById($id) {
        $message = Message::where('id', '=', $id)
            ->first();
        if(isset($message->id) == false)
            throw new Exception('資料不存在');
        return $message;
    }

    public function editNew($id, $params) {
        $messageTmp = isset($params['content']) ? $params['content'] : '';
        $message = Message::where('id', '=', $id)
            ->first();
        $message->title = isset($params['title']) ? $params['title'] : '';
        $message->content = isset($params['content']) ? $params['content'] : '';
        $message->save();
    }

    public function delNewById($id) {
        $message = Message::where('id', '=', $id)
            ->first();
        if(isset($message->id) == false)
            throw new Exception('資料不存在');
        $message->delete();
    }

    public function getAnnouncement($params) {
        $keyword = isset($params['keyword']) ? $params['keyword'] : '';
        $nowPage = isset($params['nowPage']) ? $params['nowPage'] : 1;
        $offset = isset($params['offset']) ? $params['offset'] : 10;
        $messages = Message::where('type', '=', 2)
            ->orderBy('id', 'desc')
            ->skip(($nowPage-1) * $offset)
            ->take($offset)
            ->get();
        if(isset($messages[0])) {
            return $messages;
        }
        return [];
    }

    public function getAnnouncementAmount($params) {
        $keyword = isset($params['keyword']) ? $params['keyword'] : '';
        $amount = Message::where('type', '=', 2)
            ->count();
        return $amount;
    }

    public function createAnnouncement($params) {
        $message = new Message();
        $message->type = 2;
        $message->title = isset($params['title']) ? $params['title'] : '';
        $message->content = $params['content'];
        $message->save();
    }

    public function getAnnouncementById($id) {
        $message = Message::where('id', '=', $id)
            ->first();
        if(isset($message->id) == false)
            throw new Exception('資料不存在');
        return $message;
    }

    public function editAnnouncement($id, $params) {
        $messageTmp = isset($params['content']) ? $params['content'] : '';
        $message = Message::where('id', '=', $id)
            ->first();
        $message->title = isset($params['title']) ? $params['title'] : '';
        $message->content = isset($params['content']) ? $params['content'] : '';
        $message->save();
    }

    public function delAnnouncementById($id) {
        $message = Message::where('id', '=', $id)
            ->first();
        if(isset($message->id) == false)
            throw new Exception('資料不存在');
        $message->delete();
    }

    public function getByAccountId($params) {
        $nowPage = $params['nowPage'];
        $offset = $params['offset'];
        $messageQty = Message::leftJoin('Record', 'Record.id', '=', 'Message.recordId')
            ->where(function($query) use ($params) {
                $query->orWhereIn('Message.type', [1,2])
                    ->orWhere(function($qty) use ($params) {
                        $qty->where('Record.accountId', '=', $params['accountId'])
                            ->whereIn('Message.type', [3, 4, 5]);
                    });
            })
            ;
        $messages = $messageQty->orderBy('Message.id', 'desc')
            ->skip(($nowPage-1) * $offset)
            ->take($offset)
            ->select(['Message.*'])
            ->get();
        foreach($messages as $idx => $message) {
            $messages[$idx]->titleShow = $message->content;
            switch($message->type) {
            case 1:
            case 2:
                $messages[$idx]->titleShow = $message->title;
                break;
            }
        }
        return $messages;
    }

    public function getAmountByAccountId($params) {
        $messageQty = Message::leftJoin('Record', 'Record.id', '=', 'Message.recordId')
            ->where(function($query) use ($params) {
                $query->orWhereIn('Message.type', [1,2])
                    ->orWhere(function($qty) use ($params) {
                        $qty->where('Record.accountId', '=', $params['accountId'])
                            ->whereIn('Message.type', [3, 4, 5]);
                    });
            })
            ;
        $amount = $messageQty->count();
        return $amount;
    }
}
