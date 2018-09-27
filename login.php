<?php
	session_start();
	include ('config/database.php');
	include ('module/data_login.php');
	$loginValid = 'no';
	if(isset($_POST['username'],$_POST['password'])){
		$passHash = md5($_POST['password']);
		$validation = userDataValidation($_POST['username'],$passHash);

		if(strcasecmp($validation, "true")==0){
			$loginValid = 'yes';
			// $userData = getUserData($_POST['username']);
			// $_SESSION['user_id'] = $userData['user_id'];
			// $_SESSION['username'] = $userData['user_name'];
			// $_SESSION['images'] = $userData['user_imagefile'];
			// $_SESSION['name'] = $userData['user_fullname'];
			// $_SESSION['userrole'] = $userData]['role_id'];
		} else {
			$loginValid = 'no';
		}
	}

	echo $loginValid;
	echo $validation;
	include ('template/login.php')
?>