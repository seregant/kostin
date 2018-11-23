<?php
	function userDataValidation($username, $password){
		include 'config/database.php';
		$sql = "select * from kostin_user where user_name='$username' or user_email='$username'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		if (!is_null($result)) {
			if (strcasecmp($password, $row['user_password'])==0 AND $row['role_id'] == '0001') {
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