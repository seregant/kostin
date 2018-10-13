<?php
	if (empty($_POST)){
		echo "Illegal acces!";
		exit;
	}	

	function editUserFull() {
		include $_SERVER["DOCUMENT_ROOT"]."/kostin/config/app.php";
		include $base_url.'/config/database.php';
		include $base_url.'/module/data_get.php';

		$nama = $_POST['nama'];
		$username = $_POST['username'];
		$email = $_POST['mail'];
		
		$userData = getUserData('user_id',$_GET['id']);
		$userDatas = mysqli_fetch_assoc($userData);

		$sql = "update kostin_user set
					user_fullname = '$nama',
					user_name = '$username',
					user_email = '$email'
				";

		if (isset($_POST['priv'])) {
			$sql .= ", role_id = '".$_POST['priv']."'";
		}

		if ($_FILES['foto']['size'] > 0){
			unlink("../".$userDatas['user_imagefile']);
    		unlink("../".$userDatas['user_imagethumb']);
    		$uploadResult = uploadImage('foto','user');
    		$sql .= ", user_imagefile = '".$uploadResult['imgDir']."',
					user_imagethumb = '".$uploadResult['thmbDir']."'";
		}

		$sql .= " where user_id='".$_GET['id']."'";
		$updateUser = mysqli_query($conn, $sql);

		if (!$updateUser) {
			echo "Gagal Simpan data user, sliahkan diulangi! <br /> ";
			echo mysqli_error($conn);
			echo "<br/> <input type='button' value='kembali'
					onClick='self.history.back()'> ";
			exit;
		} else {
			header('Location:../index.php?category=form&module=user&isclear=yes');
		}
	}

	function editKamar(){
		include $_SERVER["DOCUMENT_ROOT"]."/kostin/config/app.php";
		include $base_url.'/config/database.php';
		include $base_url.'/module/data_get.php';

		$panjang = $_POST['panjang'];
		$lebar = $_POST['lebar'];
		$price = $_POST['price'];
		$keterangan = $_POST['keterangan'];
		
		if (strlen(trim($keterangan))==0){
			$keterangan="";
		}


		$sql = "update kostin_kamar set 
					kamar_panjang = '$panjang',
					kamar_lebar = '$lebar',
					kamar_harga = $price,
					kamar_keterangan = '$keterangan'
				";

		if (isset($_POST['status'])) {
			$status = $_POST['status'];
			$sql .= ", kamar_status = '$status'";
		}

		$kamarData = getAllData("kostin_kamar","kamar_id");
		$kamarRow = 0;

		if (!is_null($kamarData)) {
			$kamarRow=mysqli_num_rows($kamarData)+1;
		}

		$id_kamar = "AO".sprintf('%03d', $kamarRow);

		$sql .= " where kamar_id = ".$_GET['room_id'];

		$editKamar = mysqli_query($conn, $sql);

		if (!$editKamar) {
			echo "Gagal Simpan data addon, sliahkan diulangi! <br /> ";
			echo mysqli_error($conn);
			echo "<br/> <input type='button' value='kembali'
					onClick='self.history.back()'> ";
			exit;
		} else {
			echo "Simpan data kamar berhasil";
		}
	}

	function uploadImage($dataIndex,$imgPrefix){
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/config/app.php';
		$pict_foto = $_FILES[$dataIndex]['name'];
		$pict_tmp = $_FILES[$dataIndex]['tmp_name'];
		$pict_size = $_FILES[$dataIndex]['size'];
		$pict_type = $_FILES[$dataIndex]['type'];
		$date = new DateTime();
		$timestamp = $date->getTimestamp();

		$maxPictSize = 1500000;
		$allowedType = array("image/jpeg","image/png","image/pjpeg");
		$pictDir = "uploads/images/user";
		$thumbDir = "uploads/images/user_thumb";

		if(!is_dir($base_url."/".$pictDir))
			mkdir($base_url."/".$pictDir);

		if(!is_dir($base_url."/".$thumbDir))
			mkdir($base_url."/".$thumbDir);

		$pictDst = $base_url."/".$pictDir."/".$imgPrefix."_".$timestamp.'.'.substr($pict_type, 6);
		$thumbDst = $base_url."/".$thumbDir."/thmb_".$imgPrefix.$timestamp.'.'.substr($pict_type, 6);

		$pictName = $pictDir."/".$imgPrefix."_".$timestamp.'.'.substr($pict_type, 6);
		$thumbName = $thumbDir."/thmb_".$imgPrefix.$timestamp.'.'.substr($pict_type, 6);
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

		return array('imgDir' => $pictName, 'thmbDir' => $thumbName, 'status' => $status );
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
		case '_booking.php':
				insertMasterBooking();
			break;

		case '_addon.php':
				insertMasterAddon();
			break;

		case '_kamar.php':
				insertMasterKamar();
			break;

		case 'room':
				editKamar();
			break;

		case 'user_admin':
				editUserFull();
			break;

		default:
			echo "Not found";
			break;
	}

?>