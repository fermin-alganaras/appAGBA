<?php
session_start();

require_once '..\..\..\Modelo\Usuario.php';
require_once '..\..\..\Controlador\ServidorControladores.php';

if (isset($_SESSION['user'])) {
    if (isset($_POST['pass'])) {
        $us= unserialize($_SESSION['user']);
        $pass= json_decode($_POST['pass']);
        if ($us->getPass() == $pass->antigua) {
            $b= ServidorControladores::getConUsuario()->cambiarContrasenia($us->getIdUsuario(), $pass->nueva);
            if ($b) {
                echo 1;
            }else{
                echo 0;
            }
        }
    }
}