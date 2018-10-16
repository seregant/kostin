<?php
	function getAllData($table, $columns){
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/config/database.php';
		if (is_array($columns)) {
			$selCcolumns=implode(",", $columns);
			$sql = "select ".$selCcolumns." from $table";
		} else {
			$sql = "select $columns from $table";
		}
		
		$result = mysqli_query($conn, $sql);
		return $result;
	}

	function getUserData($column, $params){
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/config/database.php';
		$sql = "select * from kostin_user where $column = '$params'";
		$result = mysqli_query($conn, $sql);
		return $result;
	}

	function getRoomData($params){
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/config/database.php';
		$sql = "select * from kostin_kamar where kamar_id = '$params'";
		$result = mysqli_query($conn, $sql);
		return $result;
	}

	function getRentData($params){
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/config/database.php';
		$sql = "select * from kostin_sewa where sewa_id = '$params'";
		$result = mysqli_query($conn, $sql);
		return $result;
	}

	function getAvailRoom (){
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/config/database.php';
		$sql = "select * from kostin_kamar where kamar_status='kosong'";
		$result = mysqli_query($conn, $sql);
		return $result;
	}

	function getAddonData($aoId) {
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/config/database.php';
		$sql = "select * from kostin_addons where ao_id='".$aoId."'";
		$result = mysqli_query($conn, $sql);
		return $result;
	}
?>