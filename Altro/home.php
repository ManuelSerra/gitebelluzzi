<?php
session_start();
include('connect.php');
$docente = $_SESSION['id'];
$classe_coordinatore = "SELECT PK_codice FROM classe WHERE FK_docente = '$docente'";
$q_classi = "SELECT FK_classe FROM classiDocente";
$q_gite = "SELECT FK_classe,CASE isConfermata WHEN 0 THEN 'in attesa' END AS 'isConfermata' FROM gitaScolastica WHERE FK_docente='$docente' AND isConfermata = 0 ";
$q_classiInGita = "select FK_classe,CASE isConfermata WHEN 0 THEN 'in attesa'  WHEN 1 THEN 'confermata' WHEN 2 THEN 'rifiutata' END AS 'isConfermata' FROM gitaScolastica WHERE FK_docente = '$docente' AND isConfermata = 1 ";

$request = mysqli_query($conn, $classe_coordinatore);
$request2 = mysqli_query($conn, $q_classi);
$request3 = mysqli_query($conn, $q_gite);
$request4 = mysqli_query($conn, $q_classiInGita);


echo "<br><h4><b> Classe coordinatore </b></h4>";
echo "<div class='classi'>";
  if(mysqli_num_rows($request) > 0){  	
    while($row = mysqli_fetch_array($request)){
      echo "<div class='classe'><a href=modulo.php?classe=".$row['PK_codice'] .">";
      echo "<h2>" . strtoupper($row['PK_codice']) . "</h2>";
      echo "<div> <h5> Status: <span style='color:green'> query </span></h5></div>";
      echo "</a></div>";
      }
  }
  
echo "</div>";
echo "<br><h4><b> Classi che andranno in gita </b></h4>";
echo "<div class='classi'>";
  if(mysqli_num_rows($request4) > 0){
    while($row4 = mysqli_fetch_array($request4)){
      echo "<div class='classe'><a href=modulo.php?classe=".$row4['FK_classe'] .">";
      echo "<h2>" . strtoupper($row4['FK_classe']) . "</h2>";
      echo "<div> <h5> Status: <span style='color:green'>".$row4['isConfermata']."</span></h5></div>";
      echo "</a></div>";
    }
  }
  
echo "</div>";
/*echo "<br><h4><b> Altre classi </b></h4>";
echo "<div class='classi'>";
  if(mysqli_num_rows($request2) > 0){
    while($row2 = mysqli_fetch_array($request2)){
      echo "<div class='classe'><a href=modulo.php?classe=".$row2['FK_classe'] .">";
      echo "<h2>" . strtoupper($row2['FK_classe']) . "</h2>";
      echo "<div> <h5> Status: <span style='color:green'>".$row."</span></h5></div>";
      echo "</a></div>";
    }
  } 
  echo "</div>";*/
  
if($docente == "codice4"){
echo "<br><h4><b> Classi richiedenti gita </b></h4>";
echo "<div class='classi'>";
  if(mysqli_num_rows($request3) > 0){
    while($row3 = mysqli_fetch_array($request3)){
      echo "<div class='classe'><a href=modulo.php?classe=".$row3['FK_classe'] .">";
      echo "<h2>" . strtoupper($row3['FK_classe']) . "</h2>";
      echo "<div> <h5> Status: <span style='color:green'>". $row3['isConfermata']. "</span></h5></div>";
      echo "</a></div>";
    }
  }
echo "</div>";
}
?>
