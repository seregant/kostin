<?php
	function getAllData($table, $columns, $limit, $offset){
		include 'config/database.php';
		if (is_array($columns)) {
			$selCcolumns=implode(",", $columns);
			$sql = "select ".$selCcolumns." from $table";
		} else {
			$sql = "select $columns from $table";
		}

		if (!is_null($limit) and !is_null($offset)) {
			$sql .=" limit $offset, $limit";
		}
		
		$result = mysqli_query($conn, $sql);
		return $result;
	}

	function getUserData($column, $params){
		include 'config/database.php';
		$sql = "select * from kostin_user where $column = '$params'";
		$result = mysqli_query($conn, $sql);
		return $result;
	}

	function getRoomData($params){
		include 'config/database.php';
		$sql = "select * from kostin_kamar where kamar_id = '$params'";
		$result = mysqli_query($conn, $sql);
		return $result;
	}

	function getRentData($params){
		include 'config/database.php';
		$sql = "select * from kostin_sewa where sewa_id = '$params'";
		$result = mysqli_query($conn, $sql);
		return $result;
	}

	function getAvailRoom (){
		include 'config/database.php';
		$sql = "select * from kostin_kamar where kamar_status='kosong'";
		$result = mysqli_query($conn, $sql);
		return $result;
	}

	function getAddonData($aoId) {
		include 'config/database.php';
		$sql = "select * from kostin_addons where ao_id='".$aoId."'";
		$result = mysqli_query($conn, $sql);
		return $result;
	}

	function getOutcomeData($outcmId) {
		include 'config/database.php';
		$sql = "select * from kostin_outcome where outcm_id='".$outcmId."'";
		$result = mysqli_query($conn, $sql);
		return $result;
	}

	function getBookingData($bookId) {
		include 'config/database.php';
		$sql = "select * from kostin_booking where book_id='".$bookId."'";
		$result = mysqli_query($conn, $sql);
		return $result;
	}

	function getBookAddonData($sewaId){
		include 'config/database.php';
		$sql = "select * from kostin_booking_ao where book_id='".$sewaId."'";
		$result = mysqli_query($conn, $sql);
		return $result;
	}

	function getBookNotification(){
		include 'config/database.php';
		$sql = "select * from kostin_booking_ao where book_id='".$sewaId."'";
		$result = mysqli_query($conn, $sql);
		return $result;
	}
?>