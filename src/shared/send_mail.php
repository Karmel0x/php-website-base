<?php
    function send_mail($email, $subject, $message){

		print_r($message);
		return;//dev

		$json = json_encode([
			"personalizations" => [[
				"to" => [[
					"email" => $email
				]]
			]],
			"from" => [
				"email" => "noreply@qwerty.net"
			],
			"subject" => $subject,
			"content" => [[
				"type" => "text/html",
				"value" => $message
			]]
		]);

		$options = [
			'http' => [
				'header'  => "Content-Type: application/json\r\nAuthorization: Bearer SG.\r\n",
				'method'  => 'POST',
				'content' => $json
			],
			"ssl" => [
				"cafile" => "/usr/local/lib/cacert.pem"
			]
		];
		file_get_contents('https://api.sendgrid.com/v3/mail/send', false, stream_context_create($options));
    }
    