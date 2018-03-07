<?php
	$servername = "localhost";
	$username = "gitebelluzzi";
	$password = "fagtetagpo55";
	$db = "my_gitebelluzzi";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $db);
    $msg = "connessione non stabilita";
	
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
?>