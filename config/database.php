<?php
error_reporting(E_ALL ^ E_DEPRECATED);
	$host = "localhost";
	$user = "root";
	$pass = "";
	$dbName = "dev_kostin";
	$db = new mysqli($host, $user, $pass, $dbName);
	$conn = mysqli_connect($host, $user, $pass);
	if (!$conn){
		die("Gagal Koneksi...");
	}
	mysqli_select_db($conn, $dbName);

?>