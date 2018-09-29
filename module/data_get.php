<?php
	function getAllData($table, $columns){
		include $_SERVER["DOCUMENT_ROOT"].'/kostin/config/database.php';
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