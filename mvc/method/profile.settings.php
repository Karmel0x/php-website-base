<?php

function process_changePassword($user_id, $post){

	include_once('mvc/method/account.php');
	$validate = [
		'password' => ['form_password', 'Password field cannot be empty'],
		//'password2' => ['form_password2', 'Second password field cannot be empty'],
		'password_old' => ['form_password_old', 'Current password field cannot be empty']
	];
	$post = form_validate($validate, $post);
	if(!is_array($post))
		return $post;

	$validate = [
		'password' => 'Password needs to be between 4 and 40 characters long',
		//'password2' => 'The two passwords u entered are not the same',
		'password_old' => 'You can\'t reuse your old password.'
	];
	$post = form_validate2($validate, $post);
	if(!is_array($post))
		return $post;

	$post['password_old'] = !empty($_SESSION['a_pass']) ? $_SESSION['a_pass'] : passw_hash($post['password_old']);

	$dbh = dbconn()->prepare("SELECT a_pass FROM b_user WHERE user_id = :user_id");
	$dbh->bindParam(':user_id', $user_id, PDO::PARAM_INT, 11);
	$dbh->execute();
	$password_old = $dbh->fetch()[0];

	if(strcmp($password_old, $post['password_old']) != 0)
		return 'Current password is wrong';

	$dbh = dbconn()->prepare("INSERT INTO b_action (a_user, a_type, a_val, a_date, a_ip) VALUES(:user_id, ".AccountActionType::PASSWORD_CHANGE.", :val, NOW(), :ip)");
	$dbh->bindParam(':user_id', $user_id, PDO::PARAM_INT, 11);
	$dbh->bindParam(':val', $password_old, PDO::PARAM_STR, 32);
	$dbh->bindParam(':ip', $GLOBALS['REQUEST_IP'], PDO::PARAM_STR, 40);
	$dbh->execute();

	$post['password'] = passw_hash($post['password']);

	$dbh = dbconn()->prepare("UPDATE b_user SET a_pass = :a_pass WHERE user_id = :user_id");
	$dbh->bindParam(':a_pass', $post['password'], PDO::PARAM_STR, 50);
	$dbh->bindParam(':user_id', $user_id, PDO::PARAM_INT, 11);
	$dbh->execute();

	if(!empty($_SESSION['a_pass']))
		unset($_SESSION['a_pass']);

	return true;
}
function process_updateDetails($user_id, $post){

	include_once('mvc/method/account.php');
	$validate = [
		'name' => ['form_name', 'Name field cannot be empty'],
	];
	$post = form_validate($validate, $post);
	if(!is_array($post))
		return $post;

	$dbh = dbconn()->prepare("UPDATE b_user_details SET `value` = :value WHERE `user_id` = :user_id AND `name` = 'name'");
	$dbh->bindParam(':value', $post['name'], PDO::PARAM_STR, 40);
	$dbh->bindParam(':user_id', $user_id, PDO::PARAM_INT, 11);
	$dbh->execute();

	return true;
}

function process_emailConfirm_send(){

	$dbh = dbconn()->prepare("SELECT max(a_time) FROM b_action WHERE a_ip = :ip");
	$dbh->bindParam(':ip', $GLOBALS['REQUEST_IP'], PDO::PARAM_STR, 40);
	$dbh->execute();
	$result = $dbh->fetch();
	
	$time = time();
	if($result[0] > $time - 300)// FloodCheck
		return 'Please wait 5 minutes before sending confirmation email again.';

	$dbh = dbconn()->prepare("SELECT user_id, a_email, a_email_confirm FROM b_user WHERE user_id = :user_id");
	$dbh->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT, 11);
	$dbh->execute();
	$result = $dbh->fetch();
	
	if(!empty($result['a_email_confirm']))
		return 'E-mail already confirmed.';

	$token = md5($result['a_email'].uniqid(rand()));
	$dbh = dbconn()->prepare("INSERT INTO b_action (a_user, a_type, a_val, a_time, a_ip) VALUES(:user_id, ".AccountActionType::MAIL_CONFIRM.", :val, :time, :ip)");
	$dbh->bindParam(':user_id', $result['user_id'], PDO::PARAM_INT, 11);
	$dbh->bindParam(':val', $token, PDO::PARAM_STR, 32);
	$dbh->bindParam(':time', $time, PDO::PARAM_INT, 11);
	$dbh->bindParam(':ip', $GLOBALS['REQUEST_IP'], PDO::PARAM_STR, 40);
	$dbh->execute();
	
	$url = URL_HOST.URL_PATH.'api/account/token?acc='.$result['a_email'].'&tok='.$token;
	$subject = $_SERVER['HTTP_HOST'].' email address confirmation';
	$message = 'To confirm your email, open the link below:<br><br>'
		.'<a target="_blank" href="'.$url.'">'.$url.'</a><br>';

	//exit($message);
	include_once('mvc/shared/send_mail.php');
	send_mail($result['a_email'], $subject, $message);

	return true;
}

function isMailConfirmed(){
	$dbh = dbconn()->prepare("SELECT a_email_confirm FROM b_user WHERE user_id = :user_id");
	$dbh->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT, 11);
	$dbh->execute();
	$res1 = $dbh->fetch();
	return !empty($res1['a_email_confirm']);
}
