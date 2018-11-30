<?php
	include 'module/send_mail.php';
	include 'config/app.php';

	if (isset($_GET['credential'])) {
		include 'module/data_get.php';
		//ambil data user
		$dataUser = mysqli_fetch_assoc(getUser($_GET['credential']));

		if (!is_null($dataUser)) {
			$subject = "Kostin Admin || Reset Password";

		//safekey untuk reset password diembed di url yang dikirimkan ke user
			$message = "http://".$_SERVER['HTTP_HOST'].$base_url."/reset_password.php?id=".$dataUser['user_name']."&safekey=".$dataUser['user_safekey'];
			sendMail($dataUser['user_fullname'], $dataUser['user_email'], $subject, $message);
			header('Location:index.php');
		} else {
			echo "data user tidak ditemukan!";
		}
	} else {
		if (isset($_GET['safekey'])) {
			if (isset($_POST['newpass'])) {
				include 'config/database.php';

				$newpass = md5($_POST['newpass']);


				$sql = "UPDATE kostin_user SET user_password = '$newpass' WHERE user_name = '".$_GET['id']."'";
				$updatePass = mysqli_query($conn, $sql);
				if (!$updatePass) {
					echo mysqli_error($conn);
					exit();
				} else {
					header('Locatoin:index.php;')
				}
			} else {
				include 'frontend/header.php';

				$dataUser = mysqli_fetch_assoc(getUser($_GET['id']));
				if ($_GET['safekey']==$dataUser['user_safekey']) {
					include 'frontend/reset_pass_form.php';
				} else {
					echo 'Data tidak ditemukan!';
				}
				
				include 'frontend/footer.php';
			}
		} else {
			header('Location:index.php');
		}
	}
?>