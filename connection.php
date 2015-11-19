<?php
	$mysql_hostname = "localhost";
	$mysql_user = "username";
	$mysql_password = "password";
	$mysql_database = "dbname";
	$prefix = "";
	$conn = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
	mysql_select_db($mysql_database, $conn) or die("Could not select database");
?>
