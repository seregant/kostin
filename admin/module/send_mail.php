<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'phpmailer/vendor/autoload.php';
	setlocale(LC_TIME, 'id_ID');

	function sendMailTagihan($type, $id){
		include 'config/database.php';
		include 'css.php';

		if ($type == 'booking') {
			$sql = "select * from kostin_booking where book_id='".$id."'";
			$sql2 = "select * from kostin_tagihan_booking where book_id='".$id."'";
			$data  = mysqli_query($conn, $sql);
			$data2  = mysqli_query($conn, $sql2);
			$dataTagihan = mysqli_fetch_assoc($data);
			$dataTagihan = mysqli_fetch_assoc($data2);

			$sql3 = 'select kamar_harga from kostin_kamar where kamar_id='.$dataTagihan['kamar_id'];
			$data3 = mysqli_query($conn, $sql3); 
			$dataTagihan = mysqli_fetch_assoc($data3);

			$sqlAddon = "SELECT `ao_name`,`ao_price` FROM `kostin_addons` WHERE `ao_id` IN (SELECT `ao_id` FROM `kostin_booking_ao` WHERE`book_id`='".$id."')";
			$dataAddon = mysqli_query($conn, $sqlAddon);
			$htmlAddon = "";
			$ao_price = 0;
			foreach ($dataAddon as $addon) {
				$htmlAddon .= '	<tr>
									<td class="col-1">'.$addon['ao_name'].'</td>
									<td class="col-2">Rp. '.number_format($addon['ao_price']).'</td>
								</tr>
								';
				$ao_price += $addon['ao_price'];
			}
			$totalInv = $dataTagihan['tagihan_jumlah'];

			$message = '
				<!DOCTYPE html>
					<html lang=en>
					<head>
						<!-- Required meta tags -->
    					<meta charset="utf-8">
    					<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    					<!-- Bootstrap CSS -->
    					<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

					   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
					    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
					    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

						<!-- Custom CSS -->
						<style>
							'.$invoice_css.'
						</style>
						<title></title>
					</head>
					<body>
					<div class="container wrapper">
						<img src="https://image.ibb.co/koKGQq/logo-email.png">
						<p>
							Dear '.$dataTagihan['book_name'].', <br>
							Selamat Datang di Kost Kami!<br>
							Tagihan Booking Kost<br/>
							Detail:
						</p>
					<div class="body-invoice">
						<div class="table-responsive">
						<table class="table">
							<tr>
								<th colspan="2">
									Invoice #'.$dataTagihan['tagihan_id'].'<br>
									Booking #'.$id.'<br>
									Tanggal 	: '.$dataTagihan['book_date'].' <br>
									Jatuh tempo : '.$dataTagihan['tagihan_duedate'].'<br>
								</th>
							</tr>
							<tr>
								<th class="col-kiri">Service</th>
								<th class="col-kanan">Harga</th>
							</tr>
							'.$htmlAddon.'
							<tr>
								<td class="col-kiri">Biaya Kamar Bulan 1</td>
								<td class="col-kanan">Rp. '.number_format($dataTagihan['kamar_harga']).'</td>
							</tr>
							<tr>
								<td class="total" >Total </td>
								<td class="total" >Rp. '.number_format($totalInv).'</td>
							</tr>
						</table>
						</div>
					</div>
					<div class="how-to">
						<div class="table-responsive">
						<table class="table">
							<tr>
								<td>
									<h3>Silakan ikuti langkah-langkah berikut untuk menyelesaikan pembayaran:</h3>
									<ol>
										<li>Transfer sesuai dengan jumlah pembayaran yang tertera pada tabel di atas.</li>
										<li>Masuk ke menu konfirmasi di website kami di <a href="project.konco.online/konfirmasi">project.konco.online/konfirmasi</a> atau klik tombol konfirmasi di bawah ini.</li>
										<li>Upload bukti transfer ke form.</li>
										<li>Klik submit dan tunggu verifikasi pembayaran dilakukan.</li>
									</ol>
									<p>*) Setelah pembayaran dikonfirmasi kamar sudah siap dihuni, notifikasi berikutnya akan kami kirimkan via email.</p>
									<p>*) Jika pembayaran tidak dilakukan sampai melewati jatuh tempo maka booking dianggap batal dan dihapus dari sistem.</p>
								</td>
							</tr>
						</table>
						</div>
					</div>
					<div class="konfirmasi">
						<a href="http://project.konco.online/index.php?no_invoice='.$dataTagihan['tagihan_id'].'"><button class="button" >Konfirmasi Pembayaran</button></a>	
					</div>
					<hr>
					<div class="row mx-auto">
						<div class="invoice-footer">
						<p>Email dibuat secara otomatis. Mohon tidak mengirimkan balasan ke email ini.</p>
						<div class="socmed">
							<p>Ikuti Kami</p>
							<ul>
						    	<li><a href="#"><img src="http://project.konco.online/frontend/icon/fb.png" alt=""></a></li>
						    	<li><a href="#"><img src="http://project.konco.online/frontend/icon/ig.png" alt=""></a></li>
							    <li><a href="#"><img src="http://project.konco.online/frontend/icon/tw.png" alt=""></a></li>
					    	</ul>
						</div>
					</div>
					</div>
					<hr>
					<div class="copyright">
						Jika butuh bantuan, gunakan halaman <a href="">Kontak Kami</a><br>
						© Copyright 2018 <span>KostIn</span>. 
					</div>
					</div>
					</body>
					</html>
			';

			$subject= "Kostin || Tagihan Booking ".$dataTagihan['tagihan_id'];	
			sendMail($dataTagihan['book_name'], $dataTagihan['book_email'], $subject, $message);
		} else {

			$sqlTagihan = "SELECT 
							`kostin_tagihan`.`tagihan_id`,
							`kostin_tagihan`.`tagihan_jumlah`,
							DATE_FORMAT(`kostin_tagihan`.`tagihan_duedate`, '%d %M %Y') AS 'tagihan_duedate', 
							`kostin_user`.`user_fullname`, 
							`kostin_user`.`user_email`,
							`kostin_sewa`.`kamar_id`, 
							`kostin_sewa`.`sewa_id`,
							`kostin_kamar`.`kamar_harga` 
						FROM `kostin_tagihan` 
						INNER JOIN `kostin_sewa` ON `kostin_tagihan`.`sewa_id` = `kostin_sewa`.`sewa_id` 
						INNER JOIN `kostin_kamar` ON `kostin_sewa`.`kamar_id` = `kostin_kamar`.`kamar_id` 
						INNER JOIN `kostin_user` ON `kostin_sewa`.`user_id` = `kostin_user`.`user_id`
						WHERE `kostin_tagihan`.`tagihan_id` = '$id'";

			$dataTagihan = mysqli_fetch_assoc(mysqli_query($conn, $sqlTagihan));
			$dataAddon = getSewaAddon($dataTagihan['sewa_id']);
			$htmlAddon = "";
			$ao_price = 0;
			foreach ($dataAddon as $addon) {
				$sqlAoPrice = "SELECT `ao_price` FROM `kostin_addons` WHERE `ao_id` = '".$addon['ao_id']."' ";
				$aoPrice = mysqli_query($conn,$sqlAoPrice);
				$htmlAddon .= '	<tr>
									<td class="col-1">'.$addon['ao_name'].'</td>
									<td class="col-2">Rp. '.number_format($addon['ao_price']).'</td>
								</tr>
								';
				$ao_price += $addon['ao_price'];
			}

			$message = '
				<!DOCTYPE html>
					<html lang=en>
					<head>
						<!-- Required meta tags -->
    					<meta charset="utf-8">
    					<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    					<!-- Bootstrap CSS -->
    					<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

					   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
					    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
					    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
						<style>
							'.$invoice_css.'
						</style>
						<title></title>
					</head>
					<body>
					<div class="container wrapper">
						<img src="https://image.ibb.co/koKGQq/logo-email.png">
						<p>
							Dear '.$dataTagihan['user_fullname'].', <br>
							Hallo, masa huni anda akan segera berakhir. <br>
							Berikut adalah tagihan kamar anda untuk bulan berikutnyat<br/>
							Detail:
						</p>
					<div class="body-invoice">
						<div class="table-responsive">
						<table class="table">
							<tr>
								<th colspan="2">
									Invoice #'.$dataTagihan['tagihan_id'].'<br>
									Tanggal 	: '.strftime('%d %B %Y').' <br>
									Jatuh tempo : '.$dataTagihan['tagihan_duedate'].'<br>
								</th>
							</tr>
							<tr>
								<th class="col-kiri">Service</th>
								<th class="col-kanan">Harga</th>
							</tr>
							'.$htmlAddon.'
							<tr>
								<td class="col-kiri">Biaya Kamar Bulan </td>
								<td class="col-kanan">Rp. '.number_format($dataTagihan['kamar_harga']).'</td>
							</tr>
							<tr>
								<td class="total" >Total </td>
								<td class="total" >Rp. '.number_format($dataTagihan['tagihan_jumlah']).'</td>
							</tr>
						</table>
						</div>
					</div>
					<div class="how-to">
						<div class="table-responsive">
						<table class="table">
							<tr>
								<td>
									<h3>Silakan ikuti langkah-langkah berikut untuk menyelesaikan pembayaran:</h3>
									<ol>
										<li>Transfer sesuai dengan jumlah pembayaran yang tertera pada tabel di atas.</li>
										<li>Masuk ke menu konfirmasi di website kami di <a href="project.konco.online/konfirmasi">project.konco.online/konfirmasi</a> atau klik tombol konfirmasi di bawah ini.</li>
										<li>Upload bukti transfer ke form.</li>
										<li>Klik submit dan tunggu verifikasi pembayaran dilakukan.</li>
									</ol>
									<p>*) Setelah pembayaran dikonfirmasi kamar sudah siap dihuni, notifikasi berikutnya akan kami kirimkan via email.</p>
									<p>*) Jika pembayaran tidak dilakukan sampai melewati jatuh tempo maka booking dianggap batal dan dihapus dari sistem.</p>
								</td>
							</tr>
						</table>
						</div>
					</div>
					<div class="konfirmasi">
						<a href="http://project.konco.online/index.php?no_invoice='.$dataTagihan['tagihan_id'].'"><button class="button" >Konfirmasi Pembayaran</button></a>	
					</div>
					<hr>
					<div class="row mx-auto">
						<div class="invoice-footer">
						<p>Email dibuat secara otomatis. Mohon tidak mengirimkan balasan ke email ini.</p>
						<div class="socmed">
							<p>Ikuti Kami</p>
							<ul>
						    	<li><a href="#"><img src="http://project.konco.online/frontend/icon/fb.png" alt=""></a></li>
						    	<li><a href="#"><img src="http://project.konco.online/frontend/icon/ig.png" alt=""></a></li>
							    <li><a href="#"><img src="http://project.konco.online/frontend/icon/tw.png" alt=""></a></li>
					    	</ul>
						</div>
					</div>
					</div>
					<hr>
					<div class="copyright">
						Jika butuh bantuan, gunakan halaman <a href="">Kontak Kami</a><br>
						© Copyright 2018 <span>KostIn</span>. 
					</div>
					</div>
					</body>
					</html>
			';

			$subject= "Kostin || Tagihan Sewa ".$dataTagihan['tagihan_id'];	
			sendMail($dataTagihan['user_fullname'], $dataTagihan['user_email'], $subject, $message);
		}
	}

	function sendPaymentBookingSuccess($username, $password, $id){
		include 'config/database.php';
		include 'css.php';
		
		$sql = "select * from kostin_booking where book_id='".$id."'";
		$sql2 = "select * from kostin_tagihan_booking where book_id='".$id."'";
		$data  = mysqli_query($conn, $sql);
		$data2  = mysqli_query($conn, $sql2);
		$dataTagihan = mysqli_fetch_assoc($data);
		$dataTagihan = mysqli_fetch_assoc($data2);

		$sql3 = 'select * from kostin_kamar where kamar_id='.$dataTagihan['kamar_id'];
		$data3 = mysqli_query($conn, $sql3); 
		$dataTagihan = mysqli_fetch_assoc($data3);

		$sqlAddon = "SELECT `ao_name`,`ao_spec`,`ao_price` FROM `kostin_addons` WHERE `ao_id` IN (SELECT `ao_id` FROM `kostin_booking_ao` WHERE`book_id`='".$id."')";
		$dataAddon = mysqli_query($conn, $sqlAddon);
		$htmlAddon = "";
		$ao_price = 0;
		foreach ($dataAddon as $addon) {
			$htmlAddon .= '	<tr>
								<td class="col-kiri">'.$addon['ao_name'].'</td>
								<td class="col-tengah">'.$addon['ao_spec'].'</td>
								<td class="col-kanan">Rp. '.number_format($addon['ao_price']).'</td>
							</tr>
							';
			$ao_price += $addon['ao_price'];
		}
		$totalInv = $dataTagihan['tagihan_jumlah'];

		$message = '
				<!DOCTYPE html>
					<html lang=en>
					<head>
						<!-- Required meta tags -->
    					<meta charset="utf-8">
    					<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    					<!-- Bootstrap CSS -->
    					<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

					   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
					    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
					    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

						<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

						<style>
							'.$payment_booking_css.'
						</style>
				<title></title>
				</head>
				<body>
				<div class="container wrapper">
					<img src="https://image.ibb.co/koKGQq/logo-email.png">
					<hr style="border: 1px solid;">
					<center><img src="https://thumb.ibb.co/mDr2SA/payment.png" style="max-width: 80%; margin: 0; padding: 0;"></center>
					<h4 style="font-size: 2em; font-weight: bolder; text-align: center;">Pembayaran booking anda sudah kami terima</h4>
						<p>
						Dear '.$dataTagihan['book_name'].', <br>
						Pembayaran booking anda telah kami terima. Berikut adalah detail pemesanan kamar anda:<br/>
						</p>
						<div class="body-invoice">
							<div class="table-responsive">
							<table class="table">
								<tr>
									<th colspan="3">
										Invoice #'.$dataTagihan['tagihan_id'].'<br>
										Tanggal 	: '.$dataTagihan['book_date'].' <br>
										Dibayar : '.$dataTagihan['tagihan_duedate'].'<br>
									</th>
								</tr>
								<tr>
									<th class="col-kiri">Kamar</th>
									<th class="col-tengah">Spesifikasi</th>
									<th class="col-kanan">Harga</th>
								</tr>
								<tr>
									<td class="col-kiri">'.$dataTagihan['kamar_id'].'</td>
									<td class="col-tengah">
										<div class="text-wrap">
											Panjang: '.$dataTagihan['kamar_panjang'].', Lebar: '.$dataTagihan['kamar_lebar'].', '.$dataTagihan['kamar_keterangan'].'
										</div>
									</td>
									<td class="col-kanan">Rp. '.number_format($dataTagihan['kamar_harga']).'</td>
								</tr>
								<tr>
									<th class="col-kiri">Add-on</th>
									<th class="col-tengah">Spesifikasi</th>
									<th class="col-kanan">Harga</th>
								</tr>
									'.$htmlAddon.'
								<tr>
									<td class="total" >Total </td>
									<td class="total" >Rp. '.number_format($totalInv).'</td>
									</tr>
							</table>
							</div>
						</div>
						<div class="how-to">
						<div class="table-responsive">
							<table class="table">
								<tr>
									<td>
										<h5 style="font-weight: bold;">Berikut adalah informasi login anda:</h5>
										<h6>Silahkan melakukan login ke user dashboard anda menggunakan username dan password berikut:</h6>
										<ul style="list-style: none;">
											<li>Username: '.$username.'</li>
											<li>Password: '.$password.'</li>
										</ul>
										<h6 style="font-size: 0.8em; font-weight: bold;">*) Jangan memberitahukan username dan password anda ke orang lain.</h6>
										<h6 style="font-size: 0.8em; font-weight: bold;">*) Penambahan Add-on kamar dapat dipesan melalui dashboard penghuni kost.</h6>
									</td>
								</tr>
							</table>
							</div>
						</div>
						<div class="konfirmasi">
							<button type="button" class="button" onclick=" window.open("http://project.konco.online")">Login</button>
						</div>
						<hr>
						<div class="row mx-auto">
							<div class="invoice-footer">
							<p>Email dibuat secara otomatis. Mohon tidak mengirimkan balasan ke email ini.</p>
							<div class="socmed">
								<p>Ikuti Kami</p>
								<ul>
						    		<li><a href="#"><img src="http://project.konco.online/frontend/icon/fb.png" alt=""></a></li>
						    		<li><a href="#"><img src="http://project.konco.online/frontend/icon/ig.png" alt=""></a></li>
							    	<li><a href="#"><img src="http://project.konco.online/frontend/icon/tw.png" alt=""></a></li>
						    	</ul>
							</div>
						</div>
						</div>
						<hr>
						<div class="copyright">
							Jika butuh bantuan, gunakan halaman <a href="">Kontak Kami</a><br>
							© Copyright 2018 <span>KostIn</span>. 
						</div>
						</div>
					</div>
					</body>
					</html>
			';
		$subject= "Kostin || Pembayaran Diterima! ".$dataTagihan['book_id'];	

		sendMail($dataTagihan['book_name'], $dataTagihan['book_email'], $subject, $message);

	}

	function sendPaymentSuccess($id){
		include 'config/database.php';
		include 'css.php';
		
		$sqlTagihan = "SELECT 
							`kostin_tagihan`.`tagihan_id`,
							`kostin_tagihan`.`tagihan_jumlah`,
							DATE_FORMAT(`kostin_tagihan`.`tagihan_paiddate`, '%d %M %Y') AS 'tagihan_paiddate', 
							`kostin_user`.`user_fullname`, 
							`kostin_user`.`user_email`,
							`kostin_sewa`.`kamar_id`, 
							`kostin_sewa`.`sewa_id`,
							`kostin_kamar`.`kamar_harga` 
						FROM `kostin_tagihan` 
						INNER JOIN `kostin_sewa` ON `kostin_tagihan`.`sewa_id` = `kostin_sewa`.`sewa_id` 
						INNER JOIN `kostin_kamar` ON `kostin_sewa`.`kamar_id` = `kostin_kamar`.`kamar_id` 
						INNER JOIN `kostin_user` ON `kostin_sewa`.`user_id` = `kostin_user`.`user_id`
						WHERE `kostin_tagihan`.`tagihan_id` = '$id'";

		$dataTagihan = mysqli_fetch_assoc(mysqli_query($conn, $sqlTagihan));
		$dataAddon = getSewaAddon($dataTagihan['sewa_id']);

		$htmlAddon = "";
		$ao_price = 0;
		foreach ($dataAddon as $addon) {
			$htmlAddon .= '	<tr>
								<td class="col-kiri">'.$addon['ao_name'].'</td>
								<td class="col-tengah">'.$addon['ao_spec'].'</td>
								<td class="col-kanan">Rp. '.number_format($addon['ao_price']).'</td>
							</tr>
							';
			$ao_price += $addon['ao_price'];
		}
		$totalInv = $dataTagihan['tagihan_jumlah'];

		$message = '
				<!DOCTYPE html>
					<html lang=en>
					<head>
						<!-- Required meta tags -->
    					<meta charset="utf-8">
    					<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    					<!-- Bootstrap CSS -->
    					<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

					   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
					    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
					    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

						<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

						<style>
							'.$payment_booking_css.'
						</style>
				<title></title>
				</head>
				<body>
				<div class="container wrapper">
					<img src="https://image.ibb.co/koKGQq/logo-email.png">
					<hr style="border: 1px solid;">
					<center><img src="https://thumb.ibb.co/mDr2SA/payment.png" style="max-width: 80%; margin: 0; padding: 0;"></center>
					<h4 style="font-size: 2em; font-weight: bolder; text-align: center;">Pembayaran booking anda sudah kami terima</h4>
						<p>
						Dear '.$dataTagihan['book_name'].', <br>
						Pembayaran booking anda telah kami terima. Berikut adalah detail pemesanan kamar anda:<br/>
						</p>
						<div class="body-invoice">
							<div class="table-responsive">
							<table class="table">
								<tr>
									<th colspan="3">
										Invoice #'.$dataTagihan['tagihan_id'].'<br>
										Tanggal 	: '.$dataTagihan['book_date'].' <br>
										Dibayar : '.$dataTagihan['tagihan_duedate'].'<br>
									</th>
								</tr>
								<tr>
									<th class="col-kiri">Kamar</th>
									<th class="col-tengah">Spesifikasi</th>
									<th class="col-kanan">Harga</th>
								</tr>
								<tr>
									<td class="col-kiri">'.$dataTagihan['kamar_id'].'</td>
									<td class="col-tengah">
										<div class="text-wrap">
											Panjang: '.$dataTagihan['kamar_panjang'].', Lebar: '.$dataTagihan['kamar_lebar'].', '.$dataTagihan['kamar_keterangan'].'
										</div>
									</td>
									<td class="col-kanan">Rp. '.number_format($dataTagihan['kamar_harga']).'</td>
								</tr>
								<tr>
									<th class="col-kiri">Add-on</th>
									<th class="col-tengah">Spesifikasi</th>
									<th class="col-kanan">Harga</th>
								</tr>
									'.$htmlAddon.'
								<tr>
									<td class="total" >Total </td>
									<td class="total" >Rp. '.number_format($totalInv).'</td>
									</tr>
							</table>
							</div>
						</div>
						<div class="how-to">
						<div class="table-responsive">
							<table class="table">
								<tr>
									<td>
										<h5 style="font-weight: bold;">Berikut adalah informasi login anda:</h5>
										<h6>Silahkan melakukan login ke user dashboard anda menggunakan username dan password berikut:</h6>
										<ul style="list-style: none;">
											<li>Username: '.$username.'</li>
											<li>Password: '.$password.'</li>
										</ul>
										<h6 style="font-size: 0.8em; font-weight: bold;">*) Jangan memberitahukan username dan password anda ke orang lain.</h6>
										<h6 style="font-size: 0.8em; font-weight: bold;">*) Penambahan Add-on kamar dapat dipesan melalui dashboard penghuni kost.</h6>
									</td>
								</tr>
							</table>
							</div>
						</div>
						<div class="konfirmasi">
							<button type="button" class="button" onclick=" window.open("http://project.konco.online")">Login</button>
						</div>
						<hr>
						<div class="row mx-auto">
							<div class="invoice-footer">
							<p>Email dibuat secara otomatis. Mohon tidak mengirimkan balasan ke email ini.</p>
							<div class="socmed">
								<p>Ikuti Kami</p>
								<ul>
						    		<li><a href="#"><img src="http://project.konco.online/frontend/icon/fb.png" alt=""></a></li>
						    		<li><a href="#"><img src="http://project.konco.online/frontend/icon/ig.png" alt=""></a></li>
							    	<li><a href="#"><img src="http://project.konco.online/frontend/icon/tw.png" alt=""></a></li>
						    	</ul>
							</div>
						</div>
						</div>
						<hr>
						<div class="copyright">
							Jika butuh bantuan, gunakan halaman <a href="">Kontak Kami</a><br>
							© Copyright 2018 <span>KostIn</span>. 
						</div>
						</div>
					</div>
					</body>
					</html>
			';
		$subject= "Kostin || Pembayaran Diterima! ".$dataTagihan['book_id'];	

		sendMail($dataTagihan['book_name'], $dataTagihan['book_email'], $subject, $message);

	}

	function sendMail($recvrName, $rcvrMail, $subject, $message){
		$mail = new PHPMailer(true);                              
		$mail->isSMTP();                                     
		$mail->Host = 'smtp.gmail.com';  
		$mail->SMTPAuth = true;                               
		$mail->Username = 'tbig.redir@gmail.com';                 
		$mail->Password = 'Qwer123#';                           
		$mail->SMTPSecure = 'tls';                                 
		$mail->Port = 587;                                   
		$mail->setFrom('tbig.redir@gmail.com', 'Kostin Admin');
		$mail->addAddress($rcvrMail, $recvrName);     		
		$mail->isHTML(true);                                  
		$mail->Subject = $subject;
		$mail->Body    = $message;
		$mail->send();
	}
?>