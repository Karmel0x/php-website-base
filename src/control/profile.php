<?php
  
  $profile_id = include_child_arg();//$_GET['id'];

  if(empty($profile_id))
    exit(header('Location: '.URL_PATH.'profile/'.$_SESSION['user_id']));

  include_once('src/model/admin.user.php');
  $profile = getUserDetailsById($profile_id, 'name');

  //if(empty($profile))
  //  return;
