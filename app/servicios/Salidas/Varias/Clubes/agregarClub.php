<?php

session_start();

require_once '..\..\..\Modelo\Usuario.php';
require_once '..\..\..\Controlador\ServidorControladores.php';

$user= unserialize($_SESSION['user']);

if ($user->getTipo()=='admin'){
    if (isset($_POST['club'])) {
        $datos= json_decode($_POST['club']);
        $b= ServidorControladores::getConClub()->agregarClub($datos->nombre, $datos->presidente, $datos->secretario,
        $datos->direccion, $datos->cp, $datos->telefono, $datos->localidad, $datos->provincia);
        echo json_encode($b);
    }
}  else {
    echo 'No tiene permisos para realizar esta accion';
}
        

