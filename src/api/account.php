<?php

    function process_post(){
        if(empty($_POST))
            return;

        switch($GLOBALS['REQUEST_URI'][1]){
            case 'login':
                return process_post_login($_POST);
            case 'register':
                return process_post_register($_POST);
            case 'reminder':
                return process_post_reminder($_POST);
        }
        return 'Something went wrong. Please try again.';
    }
    function process_get(){
        if(empty($_GET))
            return;
            
        switch($GLOBALS['REQUEST_URI'][1]){
            case 'token':
                return process_get_token();
        }
        return 'Something went wrong. Please try again.';
    }

    $result = null;
    if(!empty($_POST))
        $result = process_post();
    else if(!empty($_GET))
        $result = process_get();

    if($result === true)
		header("Location: ".URL_PATH.$need_login[0]);
	else{
		$array = @explode('?', $_SERVER['HTTP_REFERER'], 2);
		if(isset($array[1]))
			parse_str($array[1], $array[1]);
		else
			$array[1] = [];
		$array[1]['result'] = $result;
		$_SERVER['HTTP_REFERER'] = $array[0].'?'.http_build_query($array[1]);
		header("Location: ".$_SERVER['HTTP_REFERER']);
    }
