<!DOCTYPE html>
<html lang="it">

  <head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Nuova uscita didattica</title>
    <link rel="stylesheet" href="css/styleModulo.css">
    <link rel="stylesheet" href="frameworks/Bootstrap/bootstrap.css">
    <link rel="stylesheet" href="frameworks/Bootstrap/bootstrap-grid.css">
    <link rel="stylesheet" href="frameworks/Bootstrap/bootstrap-reboot.css">
    <link rel="stylesheet" href="frameworks/jQueryUI/jquery-ui.css">
    <link rel="stylesheet" href="frameworks/jQueryUI/jquery-ui.structure.css">
    <link rel="stylesheet" href="frameworks/jQueryUI/jquery-ui.theme.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


    <script src="frameworks/jQuery/jquery.js"></script>
    <script src="frameworks/jQueryUI/jquery-ui.js"></script>
    <script src="frameworks/Bootstrap/bootstrap.js"></script>
    <script src="frameworks/Bootstrap/bootstrap.bundle.js"></script>
    <script src="js/jsModulo.js"></script>


  </head>

  <body>
    <?php
    include 'backend/connect.php';
    session_start();
    include 'backend/accessLimiter.php';
    $docente = $_SESSION['id'];
    $classe = $_GET['classe'];
    



    /* CHECK LOGIN
  $query = "SELECT FK_docente FROM classe WHERE PK_codice = '" . $classe ."'";
  $result = $conn->query($query);
  $row = $result->fetch_array(MYSQL_NUM);
  if($row[0] != $docente){
  	header("location: /index.html?loginError=1");
  }
  */

    /* QUERY TOTALE ALUNNI */
    $queryNumClasse = "Select alunniGita from classe where PK_codice ='".$classe."'";
    $request = mysqli_query($conn, $queryNumClasse);
    while($row = mysqli_fetch_array($request)) {
      $numStudenti = $row['alunniGita'];
    }
    $min = ceil($numStudenti*75/100); //75% del totale degli alunni


    /* QUERY DISABILI */
    $queryDisabili = "select count(*) as disabili from classiDocente inner join classe on classe.PK_codice = classiDocente.FK_classe
  				inner join studente on studente.FK_classe = classe.PK_codice
                  where classiDocente.FK_docente = '$docente' and disabile = 1";
    $request2 = mysqli_query($conn, $queryDisabili);
    while($row = mysqli_fetch_array($request2)) {
      $disabili = $row['disabili'];
    }

    /* QUERY STRANIERI */
    $queryStranieri = "select count(*) as stranieri from classiDocente inner join classe on classe.PK_codice = classiDocente.FK_classe
  				inner join studente on studente.FK_classe = classe.PK_codice
                  where classiDocente.FK_docente = '$docente' and extracomunitario = 1";
    $request3 = mysqli_query($conn, $queryStranieri);
    while($row = mysqli_fetch_array($request3)) {
      $stranieri = $row['stranieri'];
    }

    /* QUERY CLASSI DISPONIBILI */
    $queryClassi = "SELECT classe.PK_codice as classe FROM classe left join gitaScolastica on classe.PK_codice = gitaScolastica.FK_classe where gitaScolastica.FK_classe IS NULL";
    $request4 = mysqli_query($conn, $queryClassi);
    $classi = array();
    while($row = mysqli_fetch_array($request4)) {
      array_push($classi, $row['classe']);
    }

    /* QUERY DOCENTI DISPONIBILI */
    $queryDocenti = "SELECT docente.PK_codice as codice, docente.nome as nome, docente.cognome as cognome FROM docente LEFT JOIN gitaScolastica ON gitaScolastica.FK_docente = docente.PK_codice WHERE gitaScolastica.FK_docente IS NULL AND docente.isDisponibile = 1";
    $request5 = mysqli_query($conn, $queryDocenti);
    $docenti = array();
    $codiciDocenti = array();
    while($row = mysqli_fetch_array($request5)) {
      array_push($docenti, $row['nome'] . " " .$row['cognome']);
      array_push($codiciDocenti, $row['codice']);
    }    

    ?>
    <div class='container mt-5 mb-5'>
      <h1><center>Proposta di viaggio di istruzione</center></h1>
      <form method="post" action="backend/richiestaGita.php?classe=<?php echo $classe ?>">
        <div class='row mt-5'>
          <div class='col-sm-12'>
            <div class='card'>
              <div class='card-header d-flex align-items-center'>
                <i class='material-icons mr-2'>flight_takeoff</i><span style="color: red"> <?php echo strtoupper($classe); ?> </span>
              </div>
              <div class='card-body'>
                <div class='form-row'>
                  <div class='col-sm-6'>
                    <div class='form-group'>
                      <label for='meta'>Meta</label>
                      <input class='form-control' name='meta' id='meta' type='text' required>
                    </div>
                  </div>
                  <div class='col-sm-6'>
                    <div class='form-group'>
                      <label for='metaAlternativa'>Meta Alternativa</label>
                      <input class='form-control' name='metaAlternativa' id='metaAlternativa' type='text' required>
                    </div>
                  </div>
                </div>
                <div class='form-row'>
                  <div class='col-sm-6'>
                    <div class='form-group'>
                      <label for='durataViaggio'>Durata del viaggio</label>
                      <input class='form-control' name='durataViaggio' id='durataViaggio' type='number' min="3" max="7" placeholder="Numero giorni" required>

                    </div>
                  </div>
                  <div class='col-sm-6'>
                    <div class='form-group date'>
                      <label for='periodo'>Periodo</label>
                      <div>
                        <input type="text" name="inizioPeriodo" id="inizioPeriodo" class="form-control inline" required>
                        <label for="to">-</label>
                        <input type="text" name="finePeriodo" id="finePeriodo" class="form-control inline" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class='row mt-5'>
          <div class='col-sm-12'>
            <div class='card'>
              <div class='card-header d-flex align-items-center'>
                <i class='material-icons mr-2'>people</i> <span style="color: red"><?php echo "Studenti: " . $numStudenti ?> </span>
              </div>
              <div class='card-body'>
                <div class='form-row'>
                  <div class='col-sm-4'>
                    <div class='form-group'>
                      <label for='totaleAlunni'>Alunni che intendono partecipare</label>
                      <select class="form-control" id="totaleAlunni" name="totaleAlunni" required>
                        <?php
  for ($x = $numStudenti; $min <= $x; $x--) {
    echo "<option value='$x'>". $x ." alunni</option>";
  }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class='col-sm-4'>
                    <div class='form-group'>
                      <label for='alunniDisabili'>Di cui disabili</label>
                      <select class="form-control" id="alunniDisabili" name="alunniDisabili" required>
                        <?php
                        for ($x = 0; $x <= $disabili; $x++) {
                          echo "<option value='$x'>". $x ." alunni</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class='col-sm-4'>
                    <div class='form-group'>
                      <label for='alunniStranieri'>Di cui stranieri</label>
                      <select class="form-control" id="alunniStranieri" name="alunniStranieri" required>
                        <?php
                        for ($x = 0; $x <= $stranieri; $x++) {
                          echo "<option value='$x'>". $x ." alunni</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class='form-row'>
                  <div class='col-sm-4'>
                    <div class='form-group'>
                      <label for='esigenzeDisabili'>Esigenze per alunni disabili</label>
                      <input class='form-control' name='esigenzeDisabili' id='esigenzeDisabili' type='text'>
                    </div>
                  </div>
                  <div class='col-sm-4'>
                    <div class='form-group'>
                      <label for='classeAccoppiata'>Accorpamento con classe</label>
                      <select class="form-control" id="classeAccoppiata" name="classeAccoppiata" required>
                        <?php
                        for ($x = 0; $x < sizeof($classi); $x++) {
                          echo "<option value='$classi[$x]'>". $classi[$x] ."</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class='col-sm-4'>
                    <div class='form-group'>
                      <label for='tettoMassimo'>Tetto massimo</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class='material-icons'>euro_symbol</i></span>
                        </div>
                        <input type="number" class="form-control" name="tettoMassimo">
                        <div class="input-group-append">
                          <span class="input-group-text">.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class='form-row'>
                  <div class='col-sm-6'>
                    <div class='form-group'>
                      <div class="input-group-prepend">
                        <label for='trasporto'>Mezzo di trasporto</label>
                      </div>
                      <select class="custom-select" id="trasporto" name="trasporto">
                        <option selected>Scegli...</option>
                        <option value="aereo">Aereo</option>
                        <option value="treno">Treno</option>
                        <option value="pullman">Pullman</option>
                      </select>
                    </div>
                  </div>
                  <div class='col-sm-6'>
                    <div class='form-group'>
                      <div class="input-group-prepend">
                        <label for='trasportoAlternativo'>Mezzo di trasporto alternativo</label>
                      </div>
                      <select class="custom-select" id="trasportoAlternativo" name="trasportoAlternativo">
                        <option selected>Scegli...</option>
                        <option value="aereo">Aereo</option>
                        <option value="treno">Treno</option>
                        <option value="pullman">Pullman</option>
                      </select>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>


        <div class='row mt-5'>
          <div class='col-sm-12'>
            <div class='card'>
              <div class='card-header d-flex align-items-center'>
                <i class='material-icons mr-2'>person</i> Accompagnatori
              </div>
              <div class='card-body'>
                <div class='form-row margin'>
                  <div class='col-sm-6'>
                    <div class='form-group'>
                      <div class="input-group-prepend">
                        <label for='accompagnatore'>Accompagnatore</label>
                      </div>
                      <select class="custom-select" id="accompagnatore" name="accompagnatore" required>
                        <?php
                        for ($x = 0; $x < sizeof($docenti); $x++) {
                          echo "<option value='$codiciDocenti[$x]'>". $docenti[$x] ."</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class='col-sm-6'>
                    <div class='form-group'>
                      <div class="input-group-prepend">
                        <label for='accompagnatoreSostituto'>Accompagnatore Sostituto</label>
                      </div>
                      <select class="custom-select" id="accompagnatoreSostituto" name="accompagnatoreSostituto" required>
                        <?php
                        for ($x = 0; $x < sizeof($docenti); $x++) {
                          echo "<option value='$codiciDocenti[$x]'>". $docenti[$x] ."</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class='form-row'>
                  <div class='col-sm-6'>
                    <div class='form-group'>
                      <label for='accompagnatoreDisabili'>Accompagnatore Disabili</label>
                      <input class='form-control' id='accompagnatoreDisabili' type='text'>
                    </div>
                  </div>
                  <div class='col-sm-6'>
                    <div class='form-group'>
                      <label for='accompagnatoreDisabiliSostituto'>Accompagnatore Sostituto Disabili</label>
                      <input class='form-control' id='accompagnatoreDisabiliSostituto' type='text'>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class='form-group d-flex justify-content-end mt-3'>
          <button type="button" class='btn btn-danger d-flex align-items-center mr-3' title="Annulla la richiesta di uscita didattica" onclick="window.location = 'home.html';">
            <i class='material-icons mr-2'>close</i>Annulla
          </button>
          <button class='btn btn-primary d-flex align-items-center float-right mr-3' title="Salva la richiesta per eventuali modifiche prima di inviarla per la supervisione">
            <i class='material-icons mr-2'>save</i>Salva
          </button>
          <button type="submit" name="submit" id="submit" class='btn btn-success d-flex align-items-center float-right' title="Conferma la richiesta di uscita didattica">
            <i class='material-icons mr-2'>near_me</i>Conferma
          </button>
        </div>
      </form>
    </div>
  </body>
</html>
