<?php
session_start();
	if(!isset($_SESSION['username'])){
		if (!isset($_GET['page'])) {
			if (isset($_GET['no_invoice'])) {
				include ('frontend/konfirmasi_booking.php');
			} else {
				include('frontend/index.php');
			}
		} else {
			switch ($_GET['page']) {
				case 'profile':
					include('frontend/profile.php');
					break;
				case 'booking':
					include('frontend/booking.php');
					break;
				case 'get_data_booking':
					include('frontend/get_data_booking.php');
					break;
				case 'konfirmasi_booking':
					include('frontend/konfirmasi_booking.php');
					break;
				case 'contact_us':
					include('frontend/contact_us.php');
					break;
				case 'forgot':
					include('frontend/forgot_pass.php');
					break;
				default:
					# code...
					break;
			}
	}
	} else {

		if (isset($_GET['searchTagihan'])) {
			if (strpos($_SERVER['HTTP_REFERER'], 'category=view&get=tagihan') !== false) {
	    		header("Location:index.php?category=view&get=tagihan&keyword=".$_GET['searchTagihan']);
			}
		}

		include('frontend/userDashboard/index.php');	
	}
?>