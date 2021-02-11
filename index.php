<?php
    //print_r($_SERVER);
    set_include_path(__DIR__);
    define('FILE_PATH', __DIR__.'/');
    define('URL_HOST', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST']);
    define('URL_PATH', str_replace(['index.php/', '\\/'], ['/', '/'], dirname(dirname($_SERVER['PHP_SELF'])).'/'));

    $GLOBALS['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], strlen(URL_PATH));
    $GLOBALS['REQUEST_URI'] = @explode('?', $GLOBALS['REQUEST_URI'])[0];
    $GLOBALS['REQUEST_URI'] = @explode('/', $GLOBALS['REQUEST_URI']);

    foreach($GLOBALS['REQUEST_URI'] as $key => &$val)
        $val = preg_replace("/[^a-zA-Z0-9-]/", "", $val);
    $GLOBALS['REQUEST_URI'] = array_filter($GLOBALS['REQUEST_URI']);

    require_once('config.php');
    session_start();

    $GLOBALS['head']['title'] = ucwords('Sitetitle '.implode(' ', $GLOBALS['REQUEST_URI']));

    /*$need_login = ['profile', 'admin'];//
    $need_nologin = ['account'];

    if(empty($_SESSION['user_id']) && in_array($GLOBALS['REQUEST_URI'][0], $need_login))
        exit(header("Location: ".URL_PATH.$need_nologin[0]));

    if(!empty($_SESSION['user_id']) && in_array($GLOBALS['REQUEST_URI'][0], $need_nologin))
        exit(header("Location: ".URL_PATH.$need_login[0]));*/


    include_once('src/shared/include_child.php');

    $mvc = ['model', 'control'];
    $GLOBALS['REQUEST_URI_INDEX'] = 0;
    if(include_child_arg() == 'api'){
        $mvc[1] = 'api';
        $GLOBALS['REQUEST_URI'] = array_slice($GLOBALS['REQUEST_URI'], 1);
    }

    $uri_len = count($GLOBALS['REQUEST_URI']);
    foreach($mvc as $mvcname){
        $GLOBALS['REQUEST_URI_INDEX'] = 0;
        for($i = 0; $i <= $uri_len; $i++){
            include_child($mvcname);
        }
    }

    if($mvc[1] == 'api')
        return;

    $GLOBALS['REQUEST_URI_INDEX'] = 0;
	if(include_child() === false){
        array_unshift($REQUEST_URI, 'index');
        $GLOBALS['REQUEST_URI_INDEX'] = 0;
        if(include_child() === false){
            include_once('src/404.php');
        }
    }
