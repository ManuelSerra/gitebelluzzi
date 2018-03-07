<?php
  include 'connect.php';
  session_start();
  include 'AccessLimiter.php';
  $result = $conn->query('SELECT * FROM docente where PK_codice="' . $_SESSION['id'] . '"');
  $row = $result->fetch_array(MYSQL_NUM);
  echo '<script type="text/javascript">$("#profileCode").text("' . $row[0] . '");$("#profileName").text("' . $row[1] . ' ' . $row[2] . '");$("#name").text("' . $row[1] . '");$("#surname").text("' . $row[2] . '");</script>';
  if($row[4] == 1){
    echo '<script type="text/javascript">$("#isDisponibile").prop("checked", true);</script>';
  }else{
    echo '<script type="text/javascript">$("#isDisponibile").prop("checked", false);</script>';
  }
  $result = $conn->query('SELECT FK_classe FROM docente INNER JOIN classiDocente ON docente.PK_codice = classiDocente.FK_docente WHERE docente.nome = "' . $row[1] . '" ');
  $row = $result->fetch_array(MYSQL_NUM);
  echo '<script type="text/javascript">$("#class").text("' . $row[0] . '");</script>';




  if(isset($_POST['action'])){
    switch ($_POST['action']) {
      case 'cambioDisponibilità':
        cambioDisponibilità();
        break;
      case 'cambioPassword':
        cambioPassword();
        break;
    }
  }
  function cambioDisponibilità(){
    include 'connect.php';
    $result = $conn->query('SELECT isDisponibile FROM docente WHERE PK_codice="' . $_SESSION['id'] . '"');
    $row = $result->fetch_array(MYSQL_NUM);
    if($_POST['isDisponibile'] == 'on'){
      if($row[0] == '0'){
        $conn->query('UPDATE docente SET isDisponibile =1 WHERE PK_codice="'. $_SESSION['id'].'"');
      }
      header("Location: ../profile.html");
    }else {
      if($row[0] == '1'){
        $conn->query('UPDATE docente SET isDisponibile =0 WHERE PK_codice="'. $_SESSION['id'].'"');
      }
      header("Location: ../profile.html");
    }
  }
  function cambioPassword(){
    include 'connect.php';
    if($_POST['password'] == $_POST['confirm_password'] && isset($_POST['password'])){
      $conn->query('UPDATE login SET password="' . $_POST['password'] . '" WHERE codiceDocente="' . $_SESSION['id'] . '"');
    }
    header("location: ../profile.html");
  }
?>
