<?php
session_start();

require_once '..\..\..\Modelo\Usuario.php';
require_once '..\..\..\Controlador\ServidorControladores.php';

if (isset($_SESSION['user'])) {
    $us= unserialize($_SESSION['user']);
    if ($us->getTipo()== 'admin') {
        $datos= json_decode($_POST['usuario']);
        $b=  ServidorControladores::getConUsuario()->agregarUsuario($datos->user, $datos->pass, 'club', $datos->idClub);
        if ($b instanceof Modelo\Usuario) {
            echo json_encode($b);
        }else{
            echo json_encode('true');
        }
    }
}
