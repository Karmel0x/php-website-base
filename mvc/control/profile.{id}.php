<?php
  // method to get {id} probably will be changed

  if(empty($_GET['profile']) || !is_numeric($_GET['profile']))
    return;

  include_once('mvc/method/admin.user.php');
  $profile = getUserDetailsById($_GET['profile'], 'name');

  if(empty($profile))
    return;
