<?php

	function process_get_token(){
		if(empty($_GET['acc']))
			return 'Account field cannot be empty';
		if(empty($_GET['tok']))
			return 'Token field cannot be empty';

		$result = token_login($_GET['acc'], $_GET['tok']);
	}
	function token_login(){
		$res = token_check($_GET['acc'], $_GET['tok']);
		if(!is_array($res))
			exit('Something went wrong. Please try again later. ('.$res.')');

		token_confirm($res);
		if(!isset($_SESSION['user_id'])){
			include_once('mvc/model/account.php');
			create_session($res['user_id'], $res['a_email'], $res['a_pass'], $result['rights']);
		}
		exit(header('Location: '.URL_PATH));
	}
	function token_check($login, $token){
		if(/*!ctype_alnum($login) ||*/ !ctype_alnum($token))
			return 'Token is incorrect or expired';//Username / Token can only contain a-Z and 0-9

		$dbh = dbconn()->prepare("SELECT a_user, a_time FROM b_action WHERE a_val = :token");//".AccountActionType::PASSWORD_LOST."
		$dbh->bindParam(':token', $token, PDO::PARAM_STR, 32);
		$dbh->execute();

		if($dbh->rowCount() != 1)
			return 'Token is incorrect or expired';//Token is incorrect

		$res = $dbh->fetch();
		$time = time();
		if($res['a_time'] + 36000 < $time)
			return 'Token is incorrect or expired';//Token expired

		$dbh = dbconn()->prepare("SELECT user_id, a_email, a_email_confirm, a_pass FROM b_user WHERE user_id = :user_id");
		$dbh->bindParam(':user_id', $res['a_user'], PDO::PARAM_STR, 99);
		$dbh->execute();

		if($dbh->rowCount() != 1)
			return 'Token is incorrect or expired';//Username is incorrect

		$res = $dbh->fetch();
		if($res['a_email'] != $login)
			return 'Token is incorrect or expired';//Username is incorrect

		return $res;
	}
	function token_confirm($res){
		if(!empty($res['a_email_confirm']))
			return;

		$time = time();
		$dbh = dbconn()->prepare("UPDATE b_user SET a_email_confirm = :time WHERE user_id = :user_id");
		$dbh->bindParam(':user_id', $res['user_id'], PDO::PARAM_INT, 11);
		$dbh->bindParam(':time', $time, PDO::PARAM_INT, 11);
		$dbh->execute();
	}
