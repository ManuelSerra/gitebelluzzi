<?php
session_start();
include('connect.php');
include('accessLimiter.php');
$docente = $_SESSION['id'];
$classe_coordinatore = "SELECT classe.PK_codice, CASE giteScolastica.isConfermata WHEN 0 THEN 'in attesa' WHEN 1 THEN 'confermata' when 2 then 'rifiutata' when 3 then 'salvata'  END AS 'isConfermata' FROM  classe left join giteScolastica on giteScolastica.FK_classe = classe.PK_codice where classe.FK_docente = '$docente'";
//$q_classi = "SELECT FK_classe FROM classiDocente";
$q_gite = "SELECT FK_classe,CASE isConfermata WHEN 0 THEN 'in attesa' END AS 'isConfermata' FROM giteScolastica WHERE isConfermata=0 AND FK_docente='$docente'";
$q_classiInGita = "select FK_classe,CASE isConfermata WHEN 0 THEN 'in attesa'  WHEN 1 THEN 'confermata' WHEN 2 THEN 'rifiutata' WHEN 3 then 'salvata'END AS 'isConfermata' FROM giteScolastica WHERE FK_docente = '$docente' AND isConfermata = 1";
echo $classe_coordinatore;
$request = mysqli_query($conn, $classe_coordinatore);
//$request2 = mysqli_query($conn, $q_classi);
$request3 = mysqli_query($conn, $q_gite);
$request4 = mysqli_query($conn, $q_classiInGita);


echo "<br><h4><b> Classe coordinatore </b></h4>";
echo "<div class='classi'>";
  if(mysqli_num_rows($request) > 0){
    while($row = mysqli_fetch_array($request)){
    if($row['isConfermata'] == null){
    	$row['isConfermata'] = 'in richiesta';
    }
      echo "<div class='classe'><a href=modulo.php?classe=".$row['PK_codice'] .">";
      echo "<h2>" . strtoupper($row['PK_codice']) . "</h2>";
      echo "<div> <h6> Status: <span style='color:green'> ".$row['isConfermata']." </span></h6></div>";
      echo "</a></div>";
      }
  }
echo "</div>";
echo "<br><h4><b> Classi che andranno in gita </b></h4>";
echo "<div class='classi'>";
  if(mysqli_num_rows($request4) > 0){
    while($row4 = mysqli_fetch_array($request4)){
      echo "<div class='classe'>";
      echo "<h2 style ='color:#007bff'>" . strtoupper($row4['FK_classe']) . "</h2>";
      echo "<div> <h6 style ='color:#007bff'> Status: <span style='color:green'>".$row4['isConfermata']."</span></h6></div>";
      echo "</div>";
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
      echo "<div> <h6> Status: <span style='color:green'>". $row3['isConfermata']. "</span></h6></div>";
      echo "</a></div>";
    }
  }
echo "</div>";
}
?>
