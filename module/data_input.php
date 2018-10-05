<?php
	if (empty($_POST)){
		echo "Illegal acces!";
		exit;
	}
	
	function insertMasterBooking(){
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/config/database.php';
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/module/data_get.php';
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$bdate = $_POST['tanggal-lahir'];
		$email = $_POST['mail'];
		$idntty = $_POST['noktp'];
		$status = "pending";
		$curr_date = date("Y-m-d");
		
		$date = new DateTime();
		$timestamp = $date->getTimestamp();

		$bookingData = getAllData("kostin_booking","*");
		$bookingRow = 0;
		if (!is_null($bookingData)) {
			$bookingRow = mysqli_num_rows($bookingData)+1;
		}

		$id_booking = "BO".sprintf('%08d', $bookingRow);
		
		$isValid = "yes";

		$pict_foto = $_FILES['ktp_pict']['name'];
		$pict_tmp = $_FILES['ktp_pict']['tmp_name'];
		$pict_size = $_FILES['ktp_pict']['size'];
		$pict_type = $_FILES['ktp_pict']['type'];

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
		
		$usedEmail = getAllData("kostin_booking","*");
		foreach ($usedEmail as $usedEmails) {
			if(strcasecmp($email, $usedEmails['book_email'])==0){
				echo "Email $email sudah dipakai<br>";
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
	}

	function insertMasterAddon(){
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/config/database.php';
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/module/data_get.php';
		$nama = $_POST['nama'];
		$spec = $_POST['spec'];
		$stock = $_POST['stock'];
		$price = $_POST['price'];

		$addonData = getAllData("kostin_addons","*");
		$addonRow = 0;

		if (!is_null($addonData)) {
			$addonRow=mysqli_num_rows($addonData)+1;
		}

		$id_ao = "AO".sprintf('%03d', $addonRow);

		$isValid = "yes";

		if (strlen(trim($nama))==0){
			echo "Kolom Nama Harus Diisi! <br/>";
			$isValid = "no";
		}
		if (strlen(trim($spec))==0){
			echo "Lengkapi data spesifikasi add-on! <br/>";
			$isValid = "no";
		}
		if (strlen(trim($price))==0){
			echo "Lengkapi data harga add-on! <br/>";
			$isValid = "no";
		}
		if (strlen(trim($stock))==0){
			echo "Lengkapi data stock add-on! <br/>";
			$isValid = "no";
		}

		if ($isValid == "no"){
			echo "Masih Ada Kesalahan, Silahkan perbaiki! <br/>";
			echo "<input type='button' value='kembali' onClick='self.history.back()'>";
			exit;
		}

		$sql = "insert into kostin_addons 
					(ao_id, ao_name, ao_price, ao_spec, ao_stock) values
					('$id_ao', '$nama', $price, '$spec', $stock)";

		$insertAddon = mysqli_query($conn, $sql);

		if (!$insertAddon) {
			echo "Gagal Simpan data addon, sliahkan diulangi! <br /> ";
			echo mysqli_error($conn);
			echo "<br/> <input type='button' value='kembali'
					onClick='self.history.back()'> ";
			exit;
		} else {
			echo "Simpan data addon berhasil";
		}	

	}

	function insertMasterKamar(){
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/config/database.php';
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/module/data_get.php';
		$panjang = $_POST['panjang'];
		$lebar = $_POST['lebar'];
		$price = $_POST['price'];

		$keterangan = $_POST['keterangan'];
		if (strlen(trim($keterangan))==0){
			$keterangan="";
		}

		$status = "kosong";

		$kamarData = getAllData("kostin_kamar","kamar_id");
		$kamarRow = 0;

		if (!is_null($kamarData)) {
			$kamarRow=mysqli_num_rows($kamarData)+1;
		}

		$id_kamar = "AO".sprintf('%03d', $kamarRow);

		$isValid = "yes";

		if (strlen(trim($panjang))==0){
			echo "Lengkapi data spesifikasi panjang kamar! <br/>";
			$isValid = "no";
		}
		if (strlen(trim($lebar))==0){
			echo "Lengkapi data lebar kamar! <br/>";
			$isValid = "no";
		}

		if ($isValid == "no"){
			echo "Masih Ada Kesalahan, Silahkan perbaiki! <br/>";
			echo "<input type='button' value='kembali' onClick='self.history.back()'>";
			exit;
		}

		$sql = "insert into kostin_kamar 
					(kamar_id, kamar_status, kamar_panjang, kamar_lebar, kamar_harga, kamar_keterangan) values
					('$id_kamar', '$status', $panjang, $lebar, $price, '$keterangan')";

		$insertKamar = mysqli_query($conn, $sql);

		if (!$insertKamar) {
			echo "Gagal Simpan data addon, sliahkan diulangi! <br /> ";
			echo mysqli_error($conn);
			echo "<br/> <input type='button' value='kembali'
					onClick='self.history.back()'> ";
			exit;
		} else {
			echo "Simpan data kamar berhasil";
		}	

	}

	function insertMasterOutcome(){
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/config/database.php';
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/module/data_get.php';
		$nama = $_POST['nama'];
		$value = $_POST['value'];
		$date = date("Y-m-d H:i:s");
		$tag = $_POST['tag'];

		$keterangan = $_POST['keterangan'];
		if (strlen(trim($keterangan))==0){
			$keterangan="";
		}

		$outcomeData = getAllData("kostin_outcome","*");
		$outcomeRow = 0;

		if (!is_null($outcomeData)) {
			$outcomeRow=mysqli_num_rows($outcomeData)+1;
		}

		$id_outcome = "OUT".sprintf('%07d', $outcomeRow);
	
		$isValid = "yes";

		if (strlen(trim($nama))==0){
			echo "Kolom Nama outcome Harus Diisi! <br/>";
			$isValid = "no";
		}
		if (strlen(trim($value))==0){
			echo "Lengkapi data jumlah outcome (rupiah)! <br/>";
			$isValid = "no";
		}
		if (strlen(trim($date))==0){
			echo "Lengkapi data tanggal outcome! <br/>";
			$isValid = "no";
		}

		if (strlen(trim($tag))==0){
			echo "Lengkapi data jenis pengeluaran! <br/>";
			$isValid = "no";
		}

		if ($isValid == "no"){
			echo "Masih Ada Kesalahan, Silahkan perbaiki! <br/>";
			echo "<input type='button' value='kembali' onClick='self.history.back()'>";
			exit;
		}

		$sql = "insert into kostin_outcome 
					(outcm_id, outcm_name, outcm_value, outcm_date, outcm_tag, outcm_keterangan) values
					('$id_outcome','$nama', $value, '$date', '$tag', '$keterangan')";

		$insertOutcome = mysqli_query($conn, $sql);

		if (!$insertOutcome) {
			echo "Gagal Simpan data addon, sliahkan diulangi! <br /> ";
			echo mysqli_error($conn);
			echo "<br/> <input type='button' value='kembali'
					onClick='self.history.back()'> ";
			exit;
		} else {
			echo "Simpan data outcome berhasil";
		}	

	}

	function insertMasterUser(){
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/config/database.php';
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/module/data_get.php';

		$nama = $_POST['nama'];
		$username = $_POST['username'];
		$email = $_POST['mail'];
		$pass = md5($_POST['pass']);
		$pass2 = md5($_POST['retype-pass']);
		$priv = $_POST['priv'];

		$existingUser = getAllData("kostin_user","*");
		$userCount = 0;

		if (!is_null($existingUser)) {
			$userCount=mysqli_num_rows($existingUser)+1;
		}

		$id_user = sprintf('%05d', $userCount);

		$isValid = "yes";

		if (strcmp($pass, $pass2)==0){
			echo "Validasi password salah! <br/>";
			$isValid = "no";
		}

		if (strlen(trim($nama))==0){
			echo "Kolom Nama outcome Harus Diisi! <br/>";
			$isValid = "no";
		}
		if (strlen(trim($username))==0){
			echo "Lengkapi data nama username! <br/>";
			$isValid = "no";
		}
		if (strlen(trim($email))==0){
			echo "Lengkapi data email! <br/>";
			$isValid = "no";
		}

		if ($isValid == "no"){
			echo "Masih Ada Kesalahan, Silahkan perbaiki! <br/>";
			echo "<input type='button' value='kembali' onClick='self.history.back()'>";
			exit;
		}

		$uploadResult = uploadImage('foto','user');

		$sql = "insert into kostin_user 
				(user_id, user_name, user_fullname, user_email, user_imagefile, user_imagethumb, user_password, role_id) values 
				('$id_user','$username','$nama', '$email', '".$uploadResult['imgDir']."', '".$uploadResult['thmbDir']."', '$pass', '$priv')";

		$insertUser = mysqli_query($conn, $sql);

		if (!$insertUser) {
			echo "Gagal Simpan data user, sliahkan diulangi! <br /> ";
			echo mysqli_error($conn);
			echo "<br/> <input type='button' value='kembali'
					onClick='self.history.back()'> ";
			exit;
		} else {
			echo "Simpan data user berhasil";
		}	


	}

	function insertMasterSewa(){
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/config/database.php';
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/module/data_get.php';

		$getUser = getUserData('user_name',$_POST['user']);
		$dataUser = mysqli_fetch_assoc($getUser);
		$dataSewa = getAllData('kostin_sewa','sewa_id');
		$sewaCount = 0;

		if(!is_null($dataSewa)) {
			$sewaCount = mysqli_num_rows($dataSewa)+1;
		}

		$sewaId = "SW".sprintf('%03d', $sewaCount);
		$durasi = 30;

		$sql = "insert into kostin_sewa 
				(sewa_id, kamar_id, user_id, sewa_in, sewa_durasi) values
				('$sewaId','".$_POST['kamar']."','".$dataUser['user_id']."','".$_POST['checkin']."', $durasi)";
		$sql2 = "update kostin_kamar set kamar_status = 'dihuni' where kamar_id = '".$_POST['kamar']."'";	

		$insertSewa = mysqli_query($conn, $sql);
		$updateKamar = mysqli_query($conn, $sql2);

		if (!$insertSewa) {
			echo "Gagal Simpan data sewa, sliahkan diulangi! <br /> ";
			echo mysqli_error($conn);
			echo "<br/> <input type='button' value='kembali'
					onClick='self.history.back()'> ";
			exit;
		} else {
			echo "Simpan data user berhasil";
		}

		if (!$updateKamar) {
			echo "Gagal update data kamar! <br /> ";
			echo mysqli_error($conn);
			echo "<br/> <input type='button' value='kembali'
					onClick='self.history.back()'> ";
			exit;
		} else {
			echo "Update data kamar berhasil!";
			foreach ($_POST['add-on'] as $selected_ao) {
				$sql2 = "insert into kostin_sewa_ao
						(sewa_id,ao_id)
						values('$sewaId','$selected_ao')";
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
		}	
	}

	function uploadImage($dataIndex,$imgPrefix){

		$pict_foto = $_FILES[$dataIndex]['name'];
		$pict_tmp = $_FILES[$dataIndex]['tmp_name'];
		$pict_size = $_FILES[$dataIndex]['size'];
		$pict_type = $_FILES[$dataIndex]['type'];
		$date = new DateTime();
		$timestamp = $date->getTimestamp();

		$maxPictSize = 1500000;
		$allowedType = array("image/jpeg","image/png","image/pjpeg");
		$pictDir = "../uploads/images/user";
		$thumbDir = "../uploads/images/user_thumb";

		if(!is_dir($pictDir))
			mkdir($pictDir);

		if(!is_dir($thumbDir))
			mkdir($thumbDir);

		$pictDst = $pictDir."/".$imgPrefix."_".$timestamp.'.'.substr($pict_type, 6);
		$thumbDst =$thumbDir."/thmb_".$imgPrefix.$timestamp.'.'.substr($pict_type, 6);

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

		if ($pict_size > 0) {
			if (!move_uploaded_file($pict_tmp, $pictDst)) {
				echo "Gagal upload gambar";
				$status = 'gagal';
				exit;
			} else {
				createThumbnail($pictDst, $thumbDst);
				$status = 'berhasil';
			}
		}

		return array('imgDir' => $pictDst, 'thmbDir' => $thumbDst, 'status' => $status );
	}

	function createThumbnail($file_src, $file_dst){
		list($w_src,$h_src,$type) = getimagesize($file_src);

		switch ($type) {
			case 1 :
				$img_src = imagecreatefromgif($file_src);
				break;
			case 2 :
				$img_src = imagecreatefromjpeg($file_src);
				break;
			case 3 :
				$img_src = imagecreatefrompng($file_src);
				break;
		}
		$thumb = 100;
		if ($w_src > $h_src){
			$w_dst = $thumb;
			$h_dst = round($thumb / $w_src*$h_src);
		} else {
			$w_dst = round($thumb/$h_src*$w_src);
			$h_dst = $thumb;
		}

		$img_dst = imagecreatetruecolor($w_dst, $h_dst);
		imagecopyresampled($img_dst, $img_src, 0,0,0,0,$w_dst,$h_dst,$w_src,$h_src);
		imagejpeg($img_dst, $file_dst);
		imagedestroy($img_src);
		imagedestroy($img_dst);
	}

	switch ($_GET['category']) {
		case 'booking':
				insertMasterBooking();
			break;

		case 'addon':
				insertMasterAddon();
			break;

		case 'room':
				insertMasterKamar();
			break;

		case 'outcome':
				insertMasterOutcome();
			break;

		case 'user':
				insertMasterUser();
			break;

		case 'sewa':
				insertMasterSewa();
			break;

		default:
			echo "Not found";
			break;
	}
?>