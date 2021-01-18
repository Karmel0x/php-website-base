<?php

    $uri_cur = !empty($uri_cur) ? $uri_cur : 1;

	$file = 'mvc/view/'.implode('.', array_slice($GLOBALS['REQUEST_URI'], 0, ++$uri_cur)).'.php';
    file_exists(FILE_PATH.$file) ? include($file) : include('mvc/404.php');
