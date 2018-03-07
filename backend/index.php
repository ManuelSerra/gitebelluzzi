<?php
session_start();
include('connect.php');
$username = $_POST['username'];
$password = $_POST['password'];
$username = stripslashes($username);
$username = mysql_real_escape_string($username);
$password = stripslashes($password);
$password = mysql_real_escape_string($password);

$query = "SELECT * FROM login WHERE codiceDocente='$username' and password='$password'";
$sql = mysqli_query($conn, $query);
if(mysqli_num_rows($sql) > 0){
  $row = mysqli_fetch_assoc($sql);
  $_SESSION['id'] = $row['codiceDocente'];

  header('Location: ../home.html');
} 
else
  header('Location: ../index.html');
?>
