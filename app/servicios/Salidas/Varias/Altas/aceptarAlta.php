<?php

session_start();

require_once ('..\..\..\Controlador\ServidorControladores.php');
require_once ('..\..\..\Modelo\Usuario.php');

$user= unserialize($_SESSION['user']);
$cAlta= ServidorControladores::getConAlta();

if ($user) {
    if ($user->getTipo()=='admin') {
        $idAlta=$_POST['idAlta'];
        $b=$cAlta->aceptarAlta($idAlta);
        echo $b;
    }else{
        die("EL usuario no tiene permiso para usar esta funcion");
    }
}


