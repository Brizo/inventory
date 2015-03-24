<?php
	$username = "root";
	$password = "Sihlongo7";
	$hostname = "localhost"; 

	//connection to the database
	$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
	echo "<br>";

	//select a database to work with
	$selected = mysql_select_db("snpf_inventory",$dbhandle) or die("Could not select db");
?>
