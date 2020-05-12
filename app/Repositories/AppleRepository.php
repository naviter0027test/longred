<?php

namespace App\Repositories;

use App\Account;
use Exception;
use Config;

class AppleRepository
{
    public function pushNewsToAll($content = '') {
        //\Log::info(getcwd());
        $accounts = Account::where('appleToken', '<>', '')
            ->get();
        foreach($accounts as $account)
            if(trim($account->appleToken) != '')
                $this->push($account->appleToken, $content, $account->id);
    }

    public function pushOne($accountId, $content = '') {
        $account = Account::where('appleToken', '<>', '')
            ->where('id', '=', $accountId)
            ->first();
        if(trim($account->appleToken) != '')
            $this->push($account->appleToken, $content, $account->id);
        else
            \Log::info($account->id. ': apple token no data');
    }

    public function push($deviceToken = '', $content = '', $accountId = 0) {
        if(trim($deviceToken) == '')
            throw new Exception('device token not input');

        if(trim($content) == '')
            throw new Exception('content not input');

        if($accountId == 0)
            throw new Exception('accountId not input');

        $params = array();
        $params['accountId'] = $accountId;
        $messageRepository = new MessageRepository();
        $amount = $messageRepository->getAmountByAccountId($params);
        $notReadableAmount = $amount - $messageRepository->getReadableAmountByAccountId($params);

        // Put your private key's passphrase here:
        $passphrase = config('apple.passphrase');
        $path = config('apple.pem_path');
        $server = config('apple.server');

        // Put your alert message here:
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $path);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        // Open a connection to the APNS server
        $fp = stream_socket_client(
            $server, $err,
            $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp) {
	    \Log::info("Failed to connect: $err $errstr");
            throw new Exception("Failed to connect: $err $errstr");
	}
        // Create the payload body
        $body['aps'] = array(
            'alert' => $content,
            'badge' => $notReadableAmount,
            'sound' => 'default'
        );
        // Encode the payload as JSON
        $payload = json_encode($body);

        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

        // Send it to the server
        $result3 = fwrite($fp, $msg, strlen($msg));
        if (!$result3) {
	    \Log::info("Message not deliverd");
            throw new Exception('Message not delivered');
	}

        // Close the connection to the server
        fclose($fp);
	\Log::info($result3);
    }
}
