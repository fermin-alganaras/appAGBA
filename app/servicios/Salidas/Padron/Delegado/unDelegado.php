<?php

session_start();

require_once ('..\..\..\Controlador\ServidorControladores.php');

require_once ('..\..\..\Modelo\Usuario.php');
require_once ('..\..\..\Modelo\Club.php');


if (isset($_SESSION['user'])) {
  //var_dump($_SESSION['user']);
  if (isset($_POST['idDel'])) {
      $p= ServidorControladores::getConDelegado()->traerDelegadoXID($_POST['idDel']);
      echo json_encode($p);
  }

}else{
    echo null;
}

