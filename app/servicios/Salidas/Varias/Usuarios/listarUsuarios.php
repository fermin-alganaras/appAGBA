<?php
session_start();

require_once '..\..\..\Modelo\Usuario.php';
require_once '..\..\..\Controlador\ServidorControladores.php';

if (isset($_SESSION['user'])){
    $us= unserialize($_SESSION['user']);
    if ($us->getTipo()== 'admin') {
        $usuarios= ServidorControladores::getConUsuario()->listarUsuarios();
        echo json_encode($usuarios);
    }
}


