<?php

namespace App\Repositories;

use Exception;
use Config;

class TelegramRepository
{
    public function notify($content) {
        $teleToken = config('telegram.token');
        $teleGroup = config('telegram.group_id');

        $url = "https://api.telegram.org/bot$teleToken/sendMessage";
         
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(
            array("chat_id" => $teleGroup, "text" => $content)
        )); 
        $output = curl_exec($ch); 
        curl_close($ch);

        $result = json_decode($output, true);
        if(isset($result['ok']) && $result['ok'] == true) {
            return true;
        }
        throw new Exception("telegram error: $output");
         
    }
}
