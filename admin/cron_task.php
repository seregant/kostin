<?php
	include 'module/data_get.php';
	include 'module/send_mail.php';

	function notifyCanceledBooking() {
		include 'config/database.php';
		$tagihanData = getTagihanData('booking','tagihan_notified',0);
		foreach ($tagihanData as $tagihan) {
			$dueDateCount = dueDateCounter($tagihan['tagihan_duedate']);
			$bookingData = getBookingData($tagihan['book_id']);
			$booking = mysqli_fetch_assoc($bookingData);

			$message = "Transaksi pemesanan kamar kost anda telah dibatalkan karena sudah melewati jatuh tempo tagihan pembayaran biaya kost bulan pertama";
			$subject = "Kostin || Booking ".$booking['book_id']." Telah Dibatalkan";

			if ($dueDateCount < 0) {
				sendMail($booking['book_name'], $booking['book_email'], $subject, $message);
				$sql = "UPDATE `kostin_tagihan_booking` SET `tagihan_notified` = 1 WHERE `tagihan_id` = '".$tagihan['tagihan_id']."'";
				$updateTagihan = mysqli_query($conn, $sql);
				if (!$updateTagihan) {
					echo mysqli_error($conn);
					exit;
				}
			}
		}
	}

	function kurangiMasaHuni(){
		include 'config/database.php';
		$dataSewa = getAllData('kostin_sewa','*', null, null);

		foreach ($dataSewa as $sewa) {
			$durasi = $sewa['sewa_durasi'] - 1;
			$sql = "UPDATE `kostin_sewa` SET `sewa_durasi` = $durasi WHERE `sewa_id` = '".$sewa['sewa_id']."'";
			$updateSewa = mysqli_query($conn, $sql);
				if (!$updateSewa) {
					echo mysqli_error($conn);
					exit;
				}

		}
	}

	function generateTagihanBulanan(){
		include 'config/database.php';
		$dataSewa = getAllData('kostin_sewa','*',null,null);

		$date = new DateTime();
		$duedate = $date->add(new DateInterval('P7D'));
		$duedate = $date->format('Y-m-d');

		foreach ($dataSewa as $sewa) {
			if ($sewa['sewa_durasi'] <= 4) {
				$dataKamar = getRoomData($sewa['kamar_id']);
				$kamar = mysqli_fetch_assoc($dataKamar);

				$dataAddon = getSewaAddon($sewa['sewa_id']);
				$biayaAddon = 0;

				if (mysqli_num_rows($dataAddon) > 0) {
					foreach ($dataAddon as $addon) {
						$biayaAddon += $addon['ao_price'];
					}
				}

				$tagihanCount = mysqli_num_rows(getAllData('kostin_tagihan','*',null,null));
				$tagihanId = "TG".sprintf("%08d", $tagihanCount+1);
				$biayaTotal = $biayaAddon + $kamar['kamar_harga'];

				$sqlTagihan = "INSERT INTO `kostin_tagihan` (`tagihan_id`,`sewa_id`,`tagihan_jumlah`,`tagihan_duedate`,`tagihan_status`) VALUES ('$tagihanId','".$sewa['sewa_id']."',$biayaTotal,'$duedate','pending')";

				$generateTagihan = mysqli_query($conn, $sqlTagihan);
				if (!$generateTagihan) {
					echo mysqli_error($conn);
					exit;
				}
				sendMailTagihan('sewa', $tagihanId);
				echo "email sent!<br>";
			}
		}
	}

	//notifyCanceledBooking();
	//kurangiMasaHuni();
	generateTagihanBulanan();
?>