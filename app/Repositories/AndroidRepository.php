<?php

namespace App\Repositories;

use App\Account;
use Exception;
use Config;

class AndroidRepository
{
    public function push($deviceToken = '', $content = '', $accountId = 0) {
        if(trim($deviceToken) == '')
            throw new Exception('device token not input');

        if(trim($content) == '')
            throw new Exception('content not input');

        /*
        if($accountId == 0)
            throw new Exception('accountId not input');

        $params = array();
        $params['accountId'] = $accountId;
        $messageRepository = new MessageRepository();
        $amount = $messageRepository->getAmountByAccountId($params);
        $notReadableAmount = $amount - $messageRepository->getReadableAmountByAccountId($params);
         */

        // Put your private key's passphrase here:
        $apiKey = config('fcm.key');
        $server = config('fcm.server');

        $msg = array(
            'body'  =>  $content,
            'title' =>  $content,
        );

        $fields = array(
            'to' => $deviceToken,
            'notification' => $msg);

        $headers = array(
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        return $result;
    }

    public function pushTest() {
        $apiKey = config('fcm.key');
        $server = config('fcm.server');
        $deviceToken = config('fcm.test_token');
        $content = "中文通知";

        if(trim($deviceToken) == '')
            throw new Exception('please input device token');

        $msg = array(
            'body'  =>  $content,
            'title' =>  '長鴻通知',
        );

        $fields = array(
            'to' => $deviceToken,
            'notification' => $msg);

        $headers = array(
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        return $result;
    }
}
