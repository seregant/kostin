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

	//notifyCanceledBooking();
	//kurangiMasaHuni();
?>