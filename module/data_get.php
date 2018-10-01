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
?>