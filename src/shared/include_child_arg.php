<?php

    if(!isset($REQUEST_URI_default))
        $REQUEST_URI_default = '';

    if(count($GLOBALS['REQUEST_URI']) <= $GLOBALS['REQUEST_URI_INDEX'])
        return $REQUEST_URI_default;

    $REQUEST_URI_page = $GLOBALS['REQUEST_URI'][$GLOBALS['REQUEST_URI_INDEX']++];
    return $REQUEST_URI_page;
