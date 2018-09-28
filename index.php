<?php
	session_start();

	if(!isset($_SESSION['username'])){
		header('location:login.php');
	}

	if(!empty($_GET['report'])) {

		include('template/report.php');
	} 
	else {

		include('template/index.php');
	}
?>