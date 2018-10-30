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
			$row = mysqli_fetch_Assoc($data);
			$row2 = mysqli_fetch_Assoc($data2);
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
			$hargaKamar = 350000;
			$totalInv = $hargaKamar + $ao_price;

			$message = '
				<!DOCTYPE html>
<html>
<head>
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
			width: 55%;
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
			text-align: left;
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
	</style>
	<title></title>
</head>
<body>
<div class="wrapper">
	<img src="https://image.ibb.co/koKGQq/logo-email.png">
	<p>
		Dear '.$row['book_name'].', <br>
		Selamat Datang di Kost Kami!<br>
		Tagihan Booking Kost<br/>
		Detail:
	</p>
<div class="body-invoice">
	<table>
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
			<td class="col-2">Rp. '.number_format($hargaKamar).'</td>
		</tr>
		<tr>
			<td class="total" >Total </td>
			<td class="total" >Rp. '.number_format($totalInv).'</td>
		</tr>
	</table>
</div>
<div class="how-to">
	<table>
		<tr>
			<td>
				<h3>Silakan ikuti langkah-langkah berikut untuk menyelesaikan pembayaran:</h3>
				<ol>
					<li>Transfer sesuai dengan jumlah pembayaran yang tertera pada tabel di atas.</li>
					<li>Masuk ke menu konfirmasi di website kami di project.konco.online/konfirmasi atau klik tombol konfirmasi di bawah ini.</li>
					<li>Upload bukti transfer ke form.</li>
					<li>Klik submit dan tunggu verifikasi pembayaran dilakukan.</li>
				</ol>
				<p>*) Setelah pembayaran dikonfirmasi kamar sudah siap dihuni, notifikasi berikutnya akan kami kirimkan via email.</p>
				<p>*) Jika pembayaran tidak dilakukan sampai melewati jatuh tempo maka booking dianggap batal dan dihapus dari sistem.</p>
			</td>
		</tr>
	</table>
</div>
<div class="konfirmasi">
	<button class="button">Konfirmasi Pembayaran</button>	
</div>
<hr>
<div class="invoice-footer">
	<p>Email dibuat secara otomatis. Mohon tidak mengirimkan balasan ke email ini.</p>
	<div class="socmed">
		<p>Ikuti Kami</p>
		<ul>
    		<li><a href="#"><img src="icon/fb.png" alt=""></a></li>
    		<li><a href="#"><img src="icon/ig.png" alt=""></a></li>
    		<li><a href="#"><img src="icon/tw.png" alt=""></a></li>
    	</ul>
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
			echo "durug digawe";
		}
		//untuk email
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		        
        //Server settings
		//$mail->SMTPDebug = 2;                                 // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'tbig.redir@gmail.com';                 // SMTP username
		$mail->Password = 'Qwer123#';                           // SMTP password
		$mail->SMTPSecure = 'tls';                                 // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to          
		//            
		//            $mail->CharSet = "UTF-8";                     // TCP port to connect to

		//Recipients
		$mail->setFrom('tbig.redir@gmail.com', 'Kostin Admin');
		$mail->addAddress($row['book_email'], $book['book_name']);     // Add a recipient

		$subject= "Kostin || Tagihan Booking ".$row['book_id'];
				
		//Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $message;
		$mail->send();
	}
?>