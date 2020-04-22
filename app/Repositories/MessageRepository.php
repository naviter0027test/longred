<?php

namespace App\Repositories;

use App\Message;
use App\Account;
use App\Record;
use Exception;
use Config;

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

        $receive1 = Config::get('mail.receive1');
        $receive2 = Config::get('mail.receive2');
        $receive3 = '';
        $link = "/admin/record/edit/$recordId";

        /*
        \Mail::send('email.statusUpdate', ['link' => $link, 'content' => $content, 'recordId' => $recordId], function($mail) use ($receive1, $receive2, $receive3) {
            $fromAddr = Config::get('mail.from.address');
            $fromName = Config::get('mail.from.name');
            $testTitle = env('APP_ENV') == 'local' ? '[Test] ' : '';
            $mail->from($fromAddr, $fromName);
            $mail->to($receive1, '管理者')
                ->cc($receive2)
                ->subject("$testTitle 長鴻系統 - 狀態變動 (系統發信，請勿回覆)");
        });

        $record = Record::where('id', '=', $recordId)->first();
        if(isset($record->id) == false) {
            throw new Exception('案件不存在');
        }

        if(is_numeric($record->accountId)) {
            $testTitle = env('APP_ENV') == 'local' ? '[Test] ' : '';
            $content = $testTitle. $content;
            $appleRepository = new AppleRepository();
            $appleRepository->pushOne($record->accountId, $content);
        }
         */
    }

    //案件留言與回覆
    public function send($params) {
        $record = Record::where('id', '=', $params['recordId'])->first();
        //狀態變動的相關處理於此，比如寄信或一些通知
        $message = new Message();
        $message->content = isset($params['content']) ? $params['content'] : '';
        $message->content .= " (". $record->applicant. ")";
        $message->type = isset($params['type']) ? $params['type'] : 0;
        if(isset($params['recordId']))
            $message->recordId = $params['recordId'];
        else
            throw new Exception('recordId is required');
        $message->isAsk = $params['isAsk'];

        //使用者留言的狀況下，要發通知
        if($message->isAsk == 1) { 
            $recordId = $params['recordId'];
            $content = "使用者留言: ". $message->content;
            $receive1 = Config::get('mail.receive1');
            $receive2 = Config::get('mail.receive2');
            $receive3 = '';
            $link = "/admin/record/edit/$recordId";

            \Mail::send('email.userAsk', ['link' => $link, 'content' => $content, 'recordId' => $recordId], function($mail) use ($receive1, $receive2, $receive3) {
                $fromAddr = Config::get('mail.from.address');
                $fromName = Config::get('mail.from.name');
                $testTitle = env('APP_ENV') == 'local' ? '[Test] ' : '';
                $mail->from($fromAddr, $fromName);
                $mail->to($receive1, '管理者')
                    ->cc($receive2)
                    ->subject("$testTitle 長鴻系統 - 留言通知 (系統發信，請勿回覆)");
            });

            $teleLink = url($link);
            $teleContent = "[系統通知] 留言通知 請前往查看 $teleLink";
            $telegramRepository = new TelegramRepository();
            $telegramRepository->notify($teleContent);
        }
        if(isset($params['who']))
            $message->who = $params['who'];
        $message->save();
    }

    //案件新增通知
    public function recordAdd($params) {
        //狀態變動的相關處理於此，比如寄信或一些通知
        $recordId = 0;
        if(isset($params['recordId']))
            $recordId = $params['recordId'];
        else
            throw new Exception('recordId is required');

        //案件新增的狀況下，要發通知
        $recordId = $params['recordId'];
        $receive1 = Config::get('mail.receive1');
        $receive2 = Config::get('mail.receive2');
        $receive3 = '';
        $link = "/admin/record/edit/$recordId";

        \Mail::send('email.recordAdd', ['link' => $link, 'recordId' => $recordId], function($mail) use ($receive1, $receive2, $receive3) {
            $fromAddr = Config::get('mail.from.address');
            $fromName = Config::get('mail.from.name');
            $testTitle = env('APP_ENV') == 'local' ? '[Test] ' : '';
            $mail->from($fromAddr, $fromName);
            $mail->to([$receive1, $receive2])
                ->subject("$testTitle 長鴻系統 - 進件通知 (系統發信，請勿回覆)");
        });

        $teleLink = url($link);
        $teleContent = "[系統通知] 進件通知 請前往查看 $teleLink";
        $telegramRepository = new TelegramRepository();
        $telegramRepository->notify($teleContent);
    }

    public function getByRecordId($params) {
        $msgQty = Message::whereIn('type', [3])
            ->where('recordId', '=', $params['recordId'])
            ->whereNotNull('isAsk');
        $messages = $msgQty->get();
        return $messages;
    }

    public function additionalNotify($recordId, $notify) {
        $receive1 = Config::get('mail.receive1');
        $receive2 = Config::get('mail.receive2');
        $receive3 = '';
        $link = "/admin/record/edit/$recordId";

        //使用者補件的狀況下，要發通知
        \Mail::send('email.additionalNotify', ['link' => $link, 'notify' => $notify], function($mail) use ($receive1, $receive2, $receive3) {
            $fromAddr = Config::get('mail.from.address');
            $fromName = Config::get('mail.from.name');
            $testTitle = env('APP_ENV') == 'local' ? '[Test] ' : '';
            $mail->from($fromAddr, $fromName);
            $mail->to($receive1, '管理者')
                ->cc($receive2)
                ->subject("$testTitle 長鴻系統 - 補件通知 (系統發信，請勿回覆)");
        });

        $notifyArr = [];
        if($notify['CustGIDPicture1'] == true) {
            array_push( $notifyArr, ' 身份證照片正面 ');
        }
        if($notify['CustGIDPicture2'] == true) {
            array_push( $notifyArr, ' 身份證照片反面 ');
        }
        if($notify['applyUploadPath'] == true) {
            array_push( $notifyArr, ' 申請文件 ');
        }
        if($notify['proofOfProperty'] == true) {
            array_push( $notifyArr, ' 財力證明 ');
        }
        if($notify['otherDoc'] == true) {
            array_push( $notifyArr, ' 其他文件1 ');
        }
        if($notify['otherDoc2'] == true) {
            array_push( $notifyArr, ' 其他文件2 ');
        }
        if($notify['otherDoc3'] == true) {
            array_push( $notifyArr, ' 其他文件3 ');
        }
        if($notify['otherDoc4'] == true) {
            array_push( $notifyArr, ' 其他文件4 ');
        }
        if($notify['otherDoc5'] == true) {
            array_push( $notifyArr, ' 其他文件5 ');
        }
        if($notify['otherDoc6'] == true) {
            array_push( $notifyArr, ' 其他文件6 ');
        }
        if(count($notifyArr) > 0) {
            $message = new Message();
            $message->content = '補件通知 補件:'. implode(',', $notifyArr);
            $message->type = 4;
            $message->recordId = $recordId;
            $message->save();

            $link = "/admin/record/edit/$recordId";

            $teleLink = url($link);
            $teleContent = "[系統通知] 補件通知 請前往查看 $teleLink";
            $telegramRepository = new TelegramRepository();
            $telegramRepository->notify($teleContent);
        }
    }

    public function cancelNotify($record) {
        $link = "/admin/record/edit/". $record->id;

        $content = "取消申辦 (". $record->applicant. ")";
        //狀態變動的相關處理於此，比如寄信或一些通知
        $message = new Message();
        $message->content = $content;
        $message->type = 5;
        $message->recordId = $record->id;
        $message->save();

        $teleLink = url($link);
        $teleContent = "[系統通知] 取消申辦 請前往查看 $teleLink";
        $teleRepository = new TelegramRepository();
        $teleRepository->notify($teleContent);
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

        if(trim($message->title) != '') {
            $testTitle = env('APP_ENV') == 'local' ? '[Test] ' : '';
            $content = $testTitle. "長鴻 消息通知:". $message->title;
            $appleRepository = new AppleRepository();
            $appleRepository->pushNewsToAll($message->title);
        }
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

        if(trim($message->title) != '') {
            $testTitle = env('APP_ENV') == 'local' ? '[Test] ' : '';
            $content = $testTitle. "長鴻 公告通知:". $message->title;
            $appleRepository = new AppleRepository();
            $appleRepository->pushNewsToAll($message->title);
        }
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

    public function lists($params) {
        $nowPage = $params['nowPage'];
        $offset = $params['offset'];
        $messageQty = Message::leftJoin('Record', 'Record.id', '=', 'Message.recordId')
            ;
        $messages = $messageQty->orderBy('Message.id', 'desc')
            ->skip(($nowPage-1) * $offset)
            ->take($offset)
            ->select(['Message.*'])
            ->get();
        foreach($messages as $idx => $message) {
            $messages[$idx]->titleShow = $message->content;
            $messages[$idx]->dateShow = date('Y-m-d', strtotime($message->created_at));
            switch($message->type) {
            case 1:
            case 2:
                $messages[$idx]->titleShow = $message->title;
                break;
            }

            switch($message->type) {
            case 1:
                $messages[$idx]->typeShow = '消息'; 
                break;
            case 2:
                $messages[$idx]->typeShow = '公告';
                break;
            case 3:
                $messages[$idx]->typeShow = '案件回覆';
                break;
            case 4:
                $messages[$idx]->typeShow = '補件通知';
                break;
            case 5:
                $messages[$idx]->typeShow = '案件狀態更新';
                break;
            }
        }
        return $messages;
    }

    public function listsAmount($params) {
        $messageQty = Message::leftJoin('Record', 'Record.id', '=', 'Message.recordId')
            ;
        $amount = $messageQty->count();
        return $amount;
    }
}
