<?php
	function process_post_reminder($post){
		if(empty($_POST['form_email']))
			return 'Email address field cannot be empty';
			
		return InitReminder($_POST['form_email']);
	}
	function InitReminder($email){
		if(strlen($email) < 4 || strlen($email) > 99 || !filter_var($email, FILTER_VALIDATE_EMAIL))
			return 'Please enter a valid email address';

		$dbh = dbconn()->prepare("SELECT max(a_time) FROM b_action WHERE a_ip = :ip");
		$dbh->execute(array(":ip" => $GLOBALS['REQUEST_IP']));
		$result = $dbh->fetch();
		
		$time = time();
		if($result[0] > $time - 300)
			return 'You can init reminder only 1 time per 5 minutes';


		$dbh = dbconn()->prepare("SELECT * FROM b_user WHERE a_email = :a_email");
		$dbh->bindParam(':a_email', $email, PDO::PARAM_STR, 99);
		$dbh->execute();

		if($dbh->rowCount() < 1)
			return 'E-mail not found';

		$result = $dbh->fetch();
		
		$token = md5($result['a_email'].uniqid(rand()));
		$dbh = dbconn()->prepare("INSERT INTO b_action (a_user, a_type, a_val, a_time, a_ip) VALUES(:user_id, ".AccountActionType::PASSWORD_LOST.", :val, :time, :ip)");
		$dbh->bindParam(':user_id', $result['user_id'], PDO::PARAM_INT, 11);
		$dbh->bindParam(':val', $token, PDO::PARAM_STR, 32);
		$dbh->bindParam(':time', $time, PDO::PARAM_INT, 11);
		$dbh->bindParam(':ip', $GLOBALS['REQUEST_IP'], PDO::PARAM_STR, 40);
		$dbh->execute();
		
		$url = URL_PATH.'api/account/token?acc='.$result['a_email'].'&tok='.$token;
		$subject = $_SERVER['HTTP_HOST'].' password change request';
		$message = 'To change your password, open the link below:<br><br>'
			.'<a target="_blank" href="'.$url.'">'.$url.'</a>'
			.'<br><br><br>If you did not request a password change, please ignore this email, no changes will be made to your account.<br>';

		//exit($message);
		include_once('src/shared/send_mail.php');
		send_mail($result['a_email'], $subject, $message);
		
		return "E-mail sent. Sometimes it may take a few minutes before this email reaches your inbox. If you can't find it, check spam folder or contact support.";
	}
