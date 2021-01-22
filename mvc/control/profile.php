<?php

  if(!empty($GLOBALS['REQUEST_URI'][1]) && is_numeric($GLOBALS['REQUEST_URI'][1])){
    $_GET['profile'] = $GLOBALS['REQUEST_URI'][1];
    $GLOBALS['REQUEST_URI'][1] = '{id}';
    //include_once('mvc/method/'.implode('.', array_slice($GLOBALS['REQUEST_URI'], 0, 2)).'.php');
    include_once('mvc/control/'.implode('.', array_slice($GLOBALS['REQUEST_URI'], 0, 2)).'.php');
  }
