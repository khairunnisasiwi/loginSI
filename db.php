<?php 
	$mysql_hostname = "localhost";
	$mysql_user = "root"; 
	$mysql_password = "";
  	$mysql_database = "loginsi";

  	try {
		$conn = new PDO("mysql:host={$mysql_hostname};dbname={$mysql_database};charset=utf8", $mysql_user, $mysql_password);
	}
		catch(PDOException $ex) 
    { 
        $msg = "Failed to connect to the database"; 
    } 

  	mysqli_connect($mysql_hostname, $mysql_user, $mysql_password) or die ("Tidak bisa koneksi dengan database");
  	mysqli_select_db($mysql_database) or die ("Gagal membuka database"); 
 ?>