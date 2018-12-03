<?php
  session_start();
	if(!isset($_SESSION['username'])){
		header('location:login.php');
	} else {
		if (isset($_GET['searchBooking'])) {
			if (strpos($_SERVER['HTTP_REFERER'], 'category=view&module=booking') !== false) {
	    		header("Location:index.php?category=view&module=booking&keyword=".$_GET['searchBooking']);
			}
		}

		if (isset($_GET['searchTgBooking'])) {
			if (strpos($_SERVER['HTTP_REFERER'], 'category=view&module=tagihanBooking') !== false) {
	    		header("Location:index.php?category=view&module=tagihanBooking&keyword=".$_GET['searchTgBooking']);
			}
		}

		if (isset($_GET['searchTagihan'])) {
			if (strpos($_SERVER['HTTP_REFERER'], 'category=view&module=tagihanSewa') !== false) {
	    		header("Location:index.php?category=view&module=tagihanSewa&keyword=".$_GET['searchTagihan']);
			}
		}

		if ($_SESSION['userrole']=='00001') {
			include('template/index.php');
		} else {
			header('Location:..');
		}
	}
?>