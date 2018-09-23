<?php
	function getBookData(){
		include '../config/database.php';
		$sql = "select * from kostin_booking";
		$result = mysqli_query($conn, $sql);
		return $result;
	}
?>