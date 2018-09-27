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

	function getAllData($table){
		include '../config/database.php';
		$sql = "select * from $table";
		$result = mysqli_query($conn, $sql);
		return $result;
	}
?>