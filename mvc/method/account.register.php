<?php
	function process_post_register($post){
		
		$validate = [
			'email' => ['form_email', 'Email address field cannot be empty'],
			'password' => ['form_password', 'Password field cannot be empty'],
			//'password2' => ['form_password2', 'Second password field cannot be empty'],
			'tos' => ['form_tos', 'You have to accept Terms of Service']
		];
		$post = form_validate($validate, $post);
		if(!is_array($post))
			return $post;

		$validate = [
			'email' => 'Please enter a valid email address',
			'password' => 'Password needs to be between 4 and 40 characters long',
			//'password2' => 'The two passwords u entered are not the same',
			'tos' => 'You have to accept the Terms of Service'
		];
		$post = form_validate2($validate, $post);
		if(!is_array($post))
			return $post;

		$post = form_filter($post);


		$result = process_register($post['email'], $post['password']);
		if(!is_numeric($result))
			return $result;

			
		$register_details = [];
		if(!empty($_POST['form_name']))
			$register_details['name'] = $_POST['form_name'];
		if(!empty($_COOKIE['ref']))
			$register_details['referer'] = $_COOKIE['ref'];

		$result2 = process_register_details($result, $register_details);

		//include('mvc/method/login.php');
		create_session($result, $post['email'], '', $result['rights']);
	}


	function process_register_details($user_id, $fields){
		if(empty($user_id) || empty($fields))
			return;

		$query = '';
		$param = [];
		$i = -1;
		foreach($fields as $key => $val){
			$i++;
			$query .= ',(:user_id'.$i.', :name'.$i.', :value'.$i.')';
			$param[':user_id'.$i] = $user_id;
			$param[':name'.$i] = $key;
			$param[':value'.$i] = $val;
		}
		$query[0] = ' ';

		$dbh = dbconn()->prepare("INSERT INTO b_user_details (user_id, name, value) VALUES".$query);
		foreach($param as $key => &$val)
			$dbh->bindParam($key, $val, PDO::PARAM_STR, 99);

		$dbh->execute();
	}
	function process_register($email, $password){

		$dbh = dbconn()->prepare("SELECT max(create_date) FROM b_user WHERE ip = :ip");
		$dbh->execute(array(":ip" => $GLOBALS['REQUEST_IP']));
		$result = $dbh->fetch();

		if(strtotime($result[0]) > time() - 3600)
			return 'You can only register 1 account per hour';


		$dbh = dbconn()->prepare("SELECT count(1) FROM b_user WHERE a_email = :email");
		$dbh->bindParam(':email', $email, PDO::PARAM_STR, 99);
		$dbh->execute();
		$result = $dbh->fetch();

		if($result[0] != 0)
			return 'This email is already used by someone else';
 

		$dbh = dbconn()->prepare("INSERT INTO b_user (a_email, a_pass, create_date, ip) VALUES(:email, :password, :date, :ip)");
		$dbh->bindParam(':email', $email, PDO::PARAM_STR, 99);
		$password = passw_hash($password);
		$dbh->bindParam(':password', $password, PDO::PARAM_STR, 99);
		$date = date("Y-m-d H:i:s");
		$dbh->bindParam(':date', $date, PDO::PARAM_STR, 20);
		$dbh->bindParam(':ip', $GLOBALS['REQUEST_IP'], PDO::PARAM_STR, 40);
		$dbh->execute();

		return dbconn()->lastInsertId();
	}
	