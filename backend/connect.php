<?php
	$servername = "82.52.20.12";
	$username = "root";
	$password = "";
	$db = "gitebelluzzi";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $db);
    $msg = "connessione non stabilita";
	
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
?>
