<?php

session_start();

require_once ('..\..\..\Controlador\ServidorControladores.php');

require_once ('..\..\..\Modelo\Usuario.php');
require_once ('..\..\..\Modelo\Club.php');


if (isset($_SESSION['user'])) {
  //var_dump($_SESSION['user']);
  if (isset($_POST['idPat'])) {
      $p= ServidorControladores::getConPatinador()->traerPatinadorXID($_POST['idPat']);
      echo json_encode($p);
  }

}else{
    echo null;
}



