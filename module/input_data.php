<?php
	include '../config/database.php';
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$bdate = $_POST['tanggal-lahir'];
	$email = $_POST['mail'];
	$idntty = $_POST['noktp'];
	$status = "pending";
	$curr_date = date("Y-m-d");
	
	$date = new DateTime();
	$timestamp = $date->getTimestamp();
	$id_booking = "BO".strrev($timestamp);


	$pict_foto = $_FILES['ktp_pict']['name'];
	$pict_tmp = $_FILES['ktp_pict']['tmp_name'];
	$pict_size = $_FILES['ktp_pict']['size'];
	$pict_type = $_FILES['ktp_pict']['type'];

	$isValid = "yes";

	if (strlen(trim($nama))==0){
		echo "Kolom Nama Harus Diisi! <br/>";
		$isValid = "no";
	}
	if (strlen(trim($alamat))==0){
		echo "Lengkapi data alamat anda! <br/>";
		$isValid = "no";
	}
	if (strlen(trim($bdate))==0){
		echo "Lengkapi data tanggal lahir anda!! <br/>";
		$isValid = "no";
	}
	if (strlen(trim($email))==0){
		echo "Data email harus dilengkapi! <br/>";
		$isValid = "no";
	}
	if (strlen(trim($idntty))==0){
		echo "Data nomor identitas harus diisi! <br/>";
		$isValid = "no";
	}

	$maxPictSize = 1500000;
	$allowedType = array("image/jpeg","image/png","image/pjpeg");
	$pictDir = "../uploads/images/ktp";
	$thumbDir = "../uploads/images/ktp_thumb";

	if(!is_dir($pictDir))
		mkdir($pictDir);

	if(!is_dir($thumbDir))
		mkdir($thumbDir);

	$pictDst = $pictDir."/ktp_".$timestamp;
	$thumbDst =$thumbDir."/thmb_ktp".$timestamp;

	if($pict_size > 0) {
		if($pict_size > $maxPictSize){
			echo "Gambar terlalu besar. Maksimal ukuran gambar 1.5 MB.";
			$isValid = "no";
		}
		if(!in_array($pict_type, $allowedType)){
			echo "Tipe file gambar no dikenali!";
			$isValid = "no";
		}
	}
	
	if ($isValid == "no"){
		echo "Masih Ada Kesalahan, Silahkan perbaiki! <br/>";
		echo "<input type='button' value='kembali' onClick='self.history.back()'>";
		exit;
	}

	$sql1 = "insert into kostin_booking 
					(book_id,book_name,book_addr,book_date,book_email,book_idnty,book_idntyfile,book_status,book_bdate) values (
					'$id_booking','$nama','$alamat','$curr_date','$email','$idntty','$pictDst','$status','$bdate')";
	
	$insertBooking = mysqli_query($conn, $sql1);

	if (!$insertBooking) {
		echo "Gagal Simpan data bookin, sliahkan diulangi! <br /> ";
		echo mysqli_error($conn);
		echo "<br/> <input type='button' value='kembali'
				onClick='self.history.back()'> ";
		exit;
	} else {
		echo "Simpan data berhasil";
	}	
	
	foreach ($_POST['add-on'] as $selected_ao) {
		$sql2 = "insert into kostin_booking_ao
				(book_id,ao_id)
				values('$id_booking','$selected_ao')";
		$insertAddonBooking = mysqli_query($conn, $sql2);	
		if (!$insertAddonBooking) {
			echo "Gagal Simpan data addon dipilih<br /> ";
			echo mysqli_error($conn);
			echo "<br/> <input type='button' value='kembali'
				onClick='self.history.back()'> ";
			exit;
		} else {
			echo "Berhasil tambah data tabel booking_ao";
		}
	}
?>