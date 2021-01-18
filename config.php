<?php

	error_reporting(-1);
	date_default_timezone_set('Europe/Berlin');
	
	//HTTP_X_FORWARDED_FOR only while using cloudflare
	$GLOBALS['REQUEST_IP'] = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];

	//probaby php password_hash and password_verify functions would be better solution
	function passw_hash($password){return hash('sha256', $password.'salt1234!@#$');}

	
	$dsn = array(
		'mysql:host=127.0.0.1;dbname=database1;charset=utf8',
		'root', ''
	);

	function dbconn(){
		global $db, $dsn;

		if(empty($db)){
			try{
				$db = new PDO($dsn[0], $dsn[1], $dsn[2]);
			}
			catch(PDOException $e){
				exit('Database connection error: '.$e->getMessage());
			}
		}
		return $db;
	}
