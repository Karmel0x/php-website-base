<?php

function include_child_arg($default = ''){

    if(count($GLOBALS['REQUEST_URI']) <= $GLOBALS['REQUEST_URI_INDEX'])
        return $default;

    $REQUEST_URI_page = $GLOBALS['REQUEST_URI'][$GLOBALS['REQUEST_URI_INDEX']++];
    return $REQUEST_URI_page;
}

function include_child_get($default = 'index'){

    if(count($GLOBALS['REQUEST_URI']) <= $GLOBALS['REQUEST_URI_INDEX'])
        $GLOBALS['REQUEST_URI'][] = $default;

    $REQUEST_URI_page = implode('.', array_slice($GLOBALS['REQUEST_URI'], 0, ++$GLOBALS['REQUEST_URI_INDEX']));
    return $REQUEST_URI_page;
}

function include_child($mvc = 'view', $default = 'index'){
    $REQUEST_URI_dir = 'src/'.$mvc.'/';
    $REQUEST_URI_page = include_child_get($default);

    if(!file_exists(FILE_PATH.$REQUEST_URI_dir.$REQUEST_URI_page.'.php'))
        return false;

    include_once(FILE_PATH.$REQUEST_URI_dir.$REQUEST_URI_page.'.php');
    //else include_once('src/404.php');
    return true;
}
