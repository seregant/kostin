<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'phpmailer/vendor/autoload.php';

	function sendMailTagihan($type, $id){
		include 'config/database.php';
		if ($type = 'booking') {
			$sql = "select * from kostin_booking where book_id='".$id."'";
			$sql2 = "select * from kostin_tagihan_booking where book_id='".$id."'";
			$data  = mysqli_query($conn, $sql);
			$data2  = mysqli_query($conn, $sql2);
			$row = mysqli_fetch_assoc($data);
			$row2 = mysqli_fetch_assoc($data2);

			$sql3 = 'select kamar_harga from kostin_kamar where kamar_id='.$row['kamar_id'];
			$data3 = mysqli_query($conn, $sql3); 
			$row3 = mysqli_fetch_assoc($data3);

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
			$totalInv = $row2['tagihan_jumlah'];

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

						<style type="text/css">
							@import url("http://fonts.googleapis.com/css?family=Open+Sans");
							
							body {
					        	font-family:"Open Sans";
					        	font-style:normal;
					       		font-weight:400;
					        	src:local("Open Sans"),
					            local("OpenSans"),
					            url("http://fonts.gstatic.com/s/opensans/v10/cJZKeOuBrn4kERxqtaUH3bO3LdcAZYWl9Si6vvxL-qU.woff") format("woff");
							}

							.wrapper {
								background-color: #fff;
								border: 1px solid;
								border-color: #b7b7b7;
								width: 60%;
								padding: 3em 3em 3em 3em;
								margin: auto;
							}
							.wrapper img {
								padding-left: 3em;
								padding-top: 1em;
							}
							.wrapper p {
								padding-left: 3em;
								padding-top: 0.5em;
							}
							.body-invoice {
								width: 80%;
								border: 1px solid;
								border-color: #b7b7b7;
								border-radius: 4px;
								margin: auto;
							}
							.body-invoice table {
								width: 100%;
								background-color: #fff;
								margin: auto;
								border-radius: 4px;
							}
							.body-invoice th {
								background-color: #1971ff;
								color: white;
								font-weight: bold;
								text-align: left;
								padding: 0.5em;
							}
							.col-1 {
								border-bottom: 1px solid #ddd;
								text-align: left;
								padding-left: 1em;
							}
							.col-2 {
								border-bottom: 1px solid #ddd;
								text-align: right;
								padding-right: 1em;
							}
							.total {
								text-align: right;
								font-weight: bold;
								padding-right: 1em;
							}
							.how-to {
								width: 80%;
								border: 1px solid;
								border-radius: 4px;
								border-color: #b7b7b7;
								margin: auto;
								margin-top: 1em;
							}
							.how-to table {
								margin: auto;
								background-color: #fff;
								width: 100%;
								text-align: left;
							}
							.how-to table tr td h3{
								padding-left: 1em;
							}
							.konfirmasi {
								width: 80%;
								padding-left: 1em;
								padding-top: 1em;
								padding-bottom: 1em;
								text-align: center;
								margin: auto;
							}
							.button {
								margin: auto;
								background-color: #1971ff;
								border: none;
								color: white;
								padding: 1em 2em;
								text-align: center;
								display: inline-block;
								font-size: 1em;
								border-radius: 2px;
							}

							.button:hover {
								background-color: #0099cc;
							}

							hr {
								width: 95%;
								display: block;
								height: 1px;
								border: 0;
								border-top: 1px solid  #b7b7b7;
								margin: auto;
								padding: 0;
							}
							.invoice-footer {
								width: 80%;
								margin: auto;
								padding-top: 1em;
							}
							.invoice-footer p {
								padding: 0;
								text-align: center;
							}
							.socmed {
								margin-bottom: 1em;
							}
							.socmed p {
								text-align: right;
								margin: 0;
								padding: 0;
								font-weight: bold;
							}
							.socmed ul {
								float: right;
								padding: 0;
							}
							.socmed ul li {
								float: left;
								list-style-type: none;
								margin-bottom: 1em;
							}
							.socmed ul li a img {
								padding-top: 0px;
								padding-left: 0.5em;
								padding-bottom: 0.5em;
								max-width: 2.5em;
							}
							.copyright {
								width: 100%;
								background-color: #fff8ea;
								text-align: center;
								padding-top: 1em;
								padding-bottom: 1em;
							}
							.copyright a {
								color: #1971ff;
							}
							@media only screen and (max-width: 800px) {
								body {
									font-size: 0.75em;
								}
								.wrapper {
									width: 90%;
								}
								.wrapper img {
									max-width: 200px;
								}
								.body-invoice th {
									font-size: 0.7em;
									font-weight: bold;
								}
								.col-1 {
									font-size: 0.7em;
								}
								.col-2 {
									font-size: 0.7em;
								}
								.total {
									font-size: 0.7em;
									font-weight: bold;
								}
								.how-to table tr td h3{
									font-size: 0.8em;
									font-weight: bold;
								}
								.how-to table tr td ol li{
									font-size: 0.7em;
								}
								.how-to table tr td p{
									font-size: 0.7em;
								}
								.socmed ul li a img {
									max-width: 1.5em;
								}
							}
						</style>
						<title></title>
					</head>
					<body>
					<div class="container wrapper">
						<img src="https://image.ibb.co/koKGQq/logo-email.png">
						<p>
							Dear '.$row['book_name'].', <br>
							Selamat Datang di Kost Kami!<br>
							Tagihan Booking Kost<br/>
							Detail:
						</p>
					<div class="body-invoice">
						<div class="table-responsive">
						<table class="table">
							<tr>
								<th colspan="2">
									Invoice #'.$id.'<br>
									Tanggal 	: '.$row['book_date'].' <br>
									Jatuh tempo : '.$row2['tagihan_duedate'].'<br>
								</th>
							</tr>
							<tr>
								<th class="col-1">Service</th>
								<th class="col-2">Harga</th>
							</tr>
							'.$htmlAddon.'
							<tr>
								<td class="col-1">Biaya Kamar Bulan 1</td>
								<td class="col-2">Rp. '.number_format($row3['kamar_harga']).'</td>
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
						<button class="button">Konfirmasi Pembayaran</button>	
					</div>
					<hr>
					<div class="row mx-auto">
						<div class="invoice-footer">
						<p>Email dibuat secara otomatis. Mohon tidak mengirimkan balasan ke email ini.</p>
						<div class="socmed">
							<p>Ikuti Kami</p>
							<ul>
					    		<li><a href="#"><img src="frontend/icon/fb.png" alt=""></a></li>
					    		<li><a href="#"><img src="frontend/icon/ig.png" alt=""></a></li>
					    		<li><a href="#"><img src="frontend/icon/tw.png" alt=""></a></li>
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
		} else {
			echo "durung digawe";
		}
		
		$subject= "Kostin || Tagihan Booking ".$row['book_id'];	

		sendMail($book['book_name'], $row['book_email'], $subject, $message);
	}

	function sendPaymentSuccess(){

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