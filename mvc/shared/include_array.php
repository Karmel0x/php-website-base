<?php

if(empty($files))
    return;

$mvcs = ['model', 'control', 'view'];
foreach($mvcs as $mvc){
    foreach($files as $file){
        $file = 'mvc/'.$mvc.'/'.$file.'.php';
        file_exists(FILE_PATH.$file) && include_once($file);
    }
}
