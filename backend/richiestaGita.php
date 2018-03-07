<?php
include("connect.php");


  $classe = $_GET['classe'];

  $meta = $_POST['meta'];
  $metaAlternativa = $_POST['metaAlternativa'];
  $durataViaggio = $_POST['durataViaggio'];
  $inizioPeriodo =$_POST['inizioPeriodo'];
  $finePeriodo = $_POST['finePeriodo'];

  if($inizioPeriodo != $finePeriodo) {
    $periodo = $inizioPeriodo . " - " . $finePeriodo;
  }
  else {
    $periodo = $inizioPeriodo;
  }
  $codice = rand(5, 2005);

  $totaleAlunni = $_POST['totaleAlunni'];
  $alunniDisabili = $_POST['alunniDisabili'];
  $alunniStranieri = $_POST['alunniStranieri'];
  $esigenzeDisabili = $_POST['esigenzeDisabili'];
  $classeAccoppiata = $_POST['classeAccoppiata'];
  $tettoMassimo = $_POST['tettoMassimo'];
  $trasporto = $_POST['trasporto'];
  $trasportoAlternativo = $_POST['trasportoAlternativo'];

  $accompagnatore = $_POST['accompagnatore'];
  $accompagnatoreSostituto = $_POST['accompagnatoreSostituto'];
  $accompagnatoreDisabili = $_POST['accompagnatoreDisabili'];
  $accompagnatoreDisabiliSostituto = $_POST['accompagnatoreDisabiliSostituto'];

  if($accompagnatore != $accompagnatoreSostituto) {
    if($alunniDisabili != 0) {
      if($accompagnatoreDisabili != $accompagnatoreDisabiliSostituto) {
        $query = "INSERT INTO giteScolastica (
                      PK_codice,
                      FK_classe, partecipanti, alunniDisabili, alunniStranieri,
                      FK_docente, FK_docenteSostituto,
                      accompagnatoreDisabili, accompagnatoreDisabiliSostituto,
                      meta, metaAlternativa, periodo, durata, tettoMassimo,
                      FK_classeAggiuntiva, trasporto, trasportoAlternativo,
                      esigenzeDisabile, isConfermata) VALUES (
                        '$codice',
                        '$classe', '$totaleAlunni', '$alunniDisabili', '$alunniStranieri',
                        '$accompagnatore', '$accompagnatoreSostituto',
                        '$accompagnatoreDisabili', '$accompagnatoreDisabiliSostituto',
                        '$meta', '$metaAlternativa', '$periodo', '$durataViaggio', '$tettoMassimo',
                        '$classeAccoppiata', '$trasporto', '$trasportoAlternativo',
                        '$esigenzeDisabili', 0)";
         $result1 = mysqli_query($conn, $query);
        if($result1) {
          header("Location: ../home.html");
        }
        else {
          //code here
        }
      }
    }
    else {
      $query = "INSERT INTO giteScolastica (
                    PK_codice,
                    FK_classe, partecipanti, alunniStranieri, alunniDisabili,
                    FK_docente, FK_docenteSostituto,
                    accompagnatoreDisabili, accompagnatoreDisabiliSostituto,
                    meta, metaAlternativa, periodo, durata,FK_classeAggiuntiva,
                    tettoMassimo, trasporto, trasportoAlternativo,
                    esigenzeDisabile, isConfermata) VALUES (
                      '$codice',
                      '$classe', '$totaleAlunni', '$alunniStranieri', '$alunniDisabili',
                      '$accompagnatore', '$accompagnatoreSostituto',
                      '$accompagnatoreDisabili', '$accompagnatoreDisabiliSostituto',
                      '$meta', '$metaAlternativa', '$periodo', '$durataViaggio', '$classeAccoppiata',
                      '$tettoMassimo', '$trasporto', '$trasportoAlternativo',
                      '$esigenzeDisabili', 0)";
       $result = mysqli_query($conn, $query);   
      if($result) {
        header("Location: ../home.html");
      }
      else {
        //code here
      }
    }
  }
  else {
    //work here
  }

?>

?>
