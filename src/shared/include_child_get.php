<?php


    if(!isset($REQUEST_URI_default))
        $REQUEST_URI_default = '';

    if(count($GLOBALS['REQUEST_URI']) <= $GLOBALS['REQUEST_URI_INDEX'])
        $GLOBALS['REQUEST_URI'][] = $REQUEST_URI_default;

    $REQUEST_URI_page = implode('.', array_slice($GLOBALS['REQUEST_URI'], 0, ++$GLOBALS['REQUEST_URI_INDEX']));
    return $REQUEST_URI_page;
