<?php
	session_start();
	include ('config/database.php');
	include ('module/data_login.php');
	if(isset($_POST['username'],$_POST['password'])){
		$passHash = md5($_POST['password']);
		$validation = userDataValidation($_POST['username'],$passHash);

		if(strcasecmp($validation, "true")==0){
			echo "success";
			$userData = getUserData($_POST['username']);
			$_SESSION['user_id'] = $userData['user_id'];
			$_SESSION['username'] = $userData['user_name'];
			$_SESSION['images'] = $userData['user_imagefile'];
			$_SESSION['name'] = $userData['user_fullname'];
			$_SESSION['userrole'] = $userData]['role_id'];
			header('location:index.php');
		} else {
			$errMsg = "Kombinasi Email/Username dan password anda tidak cocok atau belum terdaftar!";
		}
	}
	include ('template/login.php')
?>