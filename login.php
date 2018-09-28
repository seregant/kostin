<?php
	session_start();
	include ('config/database.php');
	include ('module/data_login.php');
	if(isset($_POST['username'],$_POST['password'])){
		$passHash = md5($_POST['password']);
		$validation = userDataValidation($_POST['username'],$passHash);

		if(strcasecmp($validation, "true")==0){
			$userData = getUserData($_POST['username']);
			$userDatas = mysqli_fetch_assoc($userData);
			$_SESSION['user_id'] = $userDatas['user_id'];
			$_SESSION['username'] = $userDatas['user_name'];
			$_SESSION['images'] = $userDatas['user_imagefile'];
			$_SESSION['name'] = $userDatas['user_fullname'];
			$_SESSION['userrole'] = $userDatas['role_id'];
			header('location:index.php');
		} else {
			$errMsg = "Kombinasi Email/Username dan password anda tidak cocok atau belum terdaftar!";
		}
	}
	include ('template/login.php')
?>