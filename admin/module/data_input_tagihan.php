<?php
	include $_SERVER["DOCUMENT_ROOT"].'/kostin/config/app.php';
	include $base_url.'/config/database.php';
	include $base_url."/module/data_get.php";
	
	$dataSewaAll = getAllData('kostin_sewa','*');

	foreach ($dataSewaAll as $dataSewa) {
		$totalAO = mysqli_query($conn, "SELECT SUM(`ao_price`) AS 'total_ao' FROM `kostin_addons` WHERE `ao_id` IN (SELECT `ao_id` FROM `kostin_sewa_ao` WHERE `sewa_id` = '".$dataSewa['sewa_id']."')");
		$getAoPrice = mysqli_fetch_assoc($totalAO);
		$dataKamar = getRoomData($dataSewa['kamar_id']);
		$getKamarPrice = mysqli_fetch_assoc($dataKamar);
		$date = date("Y-m-d H:i:s");

		$existingBills = getAllData("kostin_tagihan","*");
		$billsCount = 0;

		if (!is_null($existingBills)) {
			$billsCount=mysqli_num_rows($existingBills)+1;
		}

		if (!is_null($getAoPrice['total_ao'])){
			$hargaAO = $getAoPrice['total_ao'];
		} else {
			$hargaAO = 0;
		}

		$bill_id = "TG".sprintf('%08d', $billsCount);
		$jumalhTagihan = $hargaAO+$getKamarPrice['kamar_harga'];

		$sql = "insert into kostin_tagihan 
				(tagihan_id, sewa_id, tagihan_jumlah, tagihan_duedate, tagihan_paiddate, tagihan_status, tagihan_paymthd) values 
				('$bill_id', '".$dataSewa['sewa_id']."', ".$jumalhTagihan.", '$date', '$date', 'paid', 'cash')";
		$saveBill = mysqli_query($conn, $sql);
		if (!$saveBill) {
			echo "Add data tagihan error ! : <br>";
			echo mysqli_error($conn);
			exit;
		}
	}
?>