<?php
	function userDataValidation($username, $password){
		include 'config/database.php';
		$sql = "select ('user_name','user_password') from kostin_user where user_name='$username' or user_email='$username'";
		$result = mysqli_query($conn, $sql);
		if (!is_null($result)) {
			if (password_verify($password, $result['user_password'])) {
				return "true";
			} else {
				return "false";
			}
		} else {
			return "false";
		}
	}

	function getUserData($username){
		include 'config/database.php';
		$sql = "select * from kostin_user where user_name='$username' or user_email='$username'";
		return mysqli_query($conn, $sql);
	}
?>