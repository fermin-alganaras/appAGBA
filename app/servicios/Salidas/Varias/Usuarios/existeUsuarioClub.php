<?php
session_start();

require_once '..\..\..\Modelo\Usuario.php';
require_once '..\..\..\Controlador\ServidorControladores.php';

if (isset($_SESSION['user'])) {
    $us= unserialize($_SESSION['user']);
    if ($us->getTipo()== 'admin') {
        $id= json_decode($_POST['idClub']);
        $b=  ServidorControladores::getConUsuario()->usuarioClub($id);
        if ($b instanceof Modelo\Usuario) {
            echo 0;
        }else{
            echo 1;
        }
    }
}
