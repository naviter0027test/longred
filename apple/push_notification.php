<?PHP
header("Content-Type:text/html; charset=utf-8");
/*  IOS Apn 推播 */
$deviceToken = "c0bde28b51301e8a236f341f15fd4bf7163ee96f319844b805271987e4f54a25";
// Put your private key's passphrase here:
$passphrase = 'E507e507';
// Put your alert message here:
$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

// Open a connection to the APNS server
$fp = stream_socket_client(
'ssl://gateway.sandbox.push.apple.com:2195', $err,
$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
if (!$fp)
exit("Failed to connect: $err $errstr" . PHP_EOL);
// Create the payload body
$body['aps'] = array(
	'alert' => "測試推撥",
	'badge' => 1,
	'sound' => 'default'
);
// Encode the payload as JSON
$payload = json_encode($body);

// Build the binary notification
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server
$result3 = fwrite($fp, $msg, strlen($msg));
		/*
		if (!$result)
			echo 'Message not delivered' . PHP_EOL;
		else
			echo 'Message successfully delivered' . PHP_EOL;
		*/
		// Close the connection to the server
fclose($fp);
							
					
?>
