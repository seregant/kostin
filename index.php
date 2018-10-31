<?php
	session_start();

	if(!isset($_SESSION['username'])){
		header('location:login.php');
	}

	if (isset($_GET['search'])) {
		if (strpos($_SERVER['HTTP_REFERER'], 'category=view&module=booking') !== false) {
    		header("Location:index.php?category=view&module=booking&keyword=".$_GET['search']);
		} else {
			echo "kampret";
		}
	}
	include('template/index.php');
?>