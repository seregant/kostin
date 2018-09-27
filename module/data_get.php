<?php
	// function getBookData(){
	// 	include '../config/database.php';
	// 	$sql = "select * from kostin_booking";
	// 	$result = mysqli_query($conn, $sql);
	// 	return $result;
	// }

	// function getAddonData(){
	// 	include '../config/database.php';
	// 	$sql = "select * from kostin_addons";
	// 	$result = mysqli_query($conn, $sql);
	// 	return $result;
	// }

	function getAllData($table, $columns){
		include '../config/database.php';
		if (is_array($columns)) {
			$selCcolumns=implode(",", $columns);
			$sql = "select (".$selCcolumns.") from $table";
		} else {
			$sql = "select $columns from $table";
		}
		
		$result = mysqli_query($conn, $sql);
		return $result;
	}
?>