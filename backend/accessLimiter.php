<?php
  session_start();
  if(is_null($_SESSION['id'])){
    echo '<script type="text/javascript">window.location.replace("../index.html?loginError=1");</script>';
  }
?>
