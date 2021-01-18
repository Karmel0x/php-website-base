<?php

	include_once('mvc/model/account.php');
	include_once('mvc/model/admin.user.php');

	if(!empty($_POST['submit'])){
		if($_POST['submit'] == AccountActionType::PASSWORD_CHANGE){
			$_GET['result'] = process_changePassword($_SESSION['user_id'], $_POST);
			if($_GET['result'] === true){
				$_GET['result'] = 'Successfully changed your password';
				$_GET['result_success'] = true;
			}
		}
		else if($_POST['submit'] == AccountActionType::DETAILS_UPDATE){
			$_GET['result'] = process_updateDetails($_SESSION['user_id'], $_POST);
			if($_GET['result'] === true){
				$_GET['result'] = 'Successfully updated account details';
				$_GET['result_success'] = true;
			}
		}
	}

	if(!empty($_POST['sendconfirm'])){
		$_GET['result'] = process_emailConfirm_send();
		if($_GET['result'] === true){
			$_GET['result'] = 'E-mail sent. Sometimes it may take a few minutes before this email reaches your inbox. If you can\'t find it, check spam folder or contact support.';
			$_GET['result_success'] = true;
		}
	}
