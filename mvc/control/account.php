<?php

	$time = time();
	setcookie('qweqeqwe', $time, 0, '/');

	/*if($GLOBALS['REQUEST_URI'][1] == 'logout'){
		$_SESSION = array();
		session_destroy();
	}*/

	$array = ['login', 'register', 'reminder'];
	if(!in_array($GLOBALS['REQUEST_URI'][1], $array)){
		header("Location: ".URL_PATH.'account/'.$array[0]);
		exit();
	}

	if(!empty($_GET['token'])){
		include_once('mvc/shared/class.signature.php');
		$array = Signature::decode_token($_GET['token']);
	}
