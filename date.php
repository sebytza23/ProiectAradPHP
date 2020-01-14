<?php
	header('Content-Type: application/json');
	
	define('DB_HOST', '127.0.0.1');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'bazadateproiect');

//get connection
	$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

	//query to get data from the table
	$query = sprintf("SELECT Phone_Brand, count(*) as phone from bazadate group by Phone_Brand");

	//execute query
	$result = $mysqli->query($query);

	//loop through the returned data
	$data = array();
	foreach ($result as $row) {
	  $data[] = $row;
	}
	
	print json_encode($data);
?>