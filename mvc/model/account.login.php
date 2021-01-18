<?php
	function process_post_login($post){

		$validate = [
			'email' => ['form_email', 'Email or password is incorrect'],
			'password' => ['form_password', 'Email or password is incorrect'],
		];
		$post = form_validate($validate, $post);
		if(!is_array($post))
			return $post;

		$validate = [
			'email' => 'Email or password is incorrect',
			'password' => 'Email or password is incorrect',
		];
		$post = form_validate2($validate, $post);
		if(!is_array($post))
			return $post;

		$post = form_filter($post);


		$result = process_login($post['email'], $post['password']);
		if(!is_array($result))
			return $result;

		create_session($result['user_id'], $result['a_email'], '', $result['rights'], !empty($post['form_remember']));
		return true;

	}
	function process_login($email, $password){

		$time = time();
		$time_pasthour = $time - 3600;
		if(empty($_COOKIE['qweqeqwe']) || !is_numeric($_COOKIE['qweqeqwe']) || $_COOKIE['qweqeqwe'] < $time_pasthour || $_COOKIE['qweqeqwe'] > $time
		|| empty($_POST['zxczczxcxz']) || !is_numeric($_POST['zxczczxcxz']) || $_POST['zxczczxcxz'] < $time_pasthour || $_POST['zxczczxcxz'] > $time)
			return 'Something went wrong. Please try again.';
			
		$dbh = dbconn()->prepare("SELECT count(1) FROM log_login WHERE a_ip = :ip AND a_date > :time");
		$dbh->bindParam(':ip', $GLOBALS['REQUEST_IP'], PDO::PARAM_STR, 40);
		$dbh->bindParam(':time', $time_pasthour, PDO::PARAM_INT, 11);
		$dbh->execute();

		if($dbh->fetch()[0] > 20)
			return 'Too much login attempts. Please try again later.';
		
		
		$dbh = dbconn()->prepare("SELECT * FROM b_user WHERE a_email = :email AND a_pass = :password");
		$dbh->bindParam(':email', $email, PDO::PARAM_STR, 99);
		$password = passw_hash($password);
		$dbh->bindParam(':password', $password, PDO::PARAM_STR, 99);
		$dbh->execute();
		$rc = $dbh->rowCount();

		$dbh1 = dbconn()->prepare("INSERT INTO log_login (a_ip, a_date, a_res) VALUES(:ip, :time, :rc)");
		$dbh1->bindParam(':ip', $GLOBALS['REQUEST_IP'], PDO::PARAM_STR, 40);
		$dbh1->bindParam(':time', $time, PDO::PARAM_INT, 11);
		$dbh1->bindParam(':rc', $rc, PDO::PARAM_INT, 11);
		$dbh1->execute();

		if($rc != 1)
			return 'Email or password is incorrect';
		
		return $dbh->fetch();
	}
	