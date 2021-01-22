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

    require_once('config.php');
    session_start();

    $head['title'] = ucwords('Sitetitle '.implode(' ', $GLOBALS['REQUEST_URI']));

    if(empty($GLOBALS['REQUEST_URI'][0]))
        $GLOBALS['REQUEST_URI'][0] = 'index';
    if(empty($GLOBALS['REQUEST_URI'][1]))
        $GLOBALS['REQUEST_URI'][1] = 'index';

    $need_login = ['profile', 'admin'];//
    $need_nologin = ['account'];

    if(empty($_SESSION['user_id']) && in_array($GLOBALS['REQUEST_URI'][0], $need_login))
        exit(header("Location: ".URL_PATH.$need_nologin[0]));

    if(!empty($_SESSION['user_id']) && in_array($GLOBALS['REQUEST_URI'][0], $need_nologin))
        exit(header("Location: ".URL_PATH.$need_login[0]));


    $exist = false;
    $mvc = ['method', 'control'];
    if($GLOBALS['REQUEST_URI'][0] == 'api'){
        $mvc[1] = 'api';
        $GLOBALS['REQUEST_URI'] = array_slice($GLOBALS['REQUEST_URI'], 1);
    }
    $ext = '.php';

    $uri_len = count($GLOBALS['REQUEST_URI']);
    foreach($mvc as $mvcname){
        for($i = 0; $i < $uri_len; $i++){
            $file = __DIR__.'/mvc/'.$mvcname.'/'.implode('.', array_slice($GLOBALS['REQUEST_URI'], 0, $i + 1)).$ext;
            file_exists($file) && $exist = true && include_once($file);//echo $file.'<br>';
        }
    }
    
    if($mvc[1] == 'api')
        return;

    $file = __DIR__.'/mvc/view/'.$GLOBALS['REQUEST_URI'][0].$ext;
    file_exists($file) && $exist = true && include_once($file);

    if(!$exist)
        array_unshift($GLOBALS['REQUEST_URI'], 'index');

    $file = __DIR__.'/mvc/view/'.$GLOBALS['REQUEST_URI'][0].$ext;
    file_exists($file) && $exist = true && include_once($file);

    //if(!$exist)
    //    include_once('mvc/view/index.php');
