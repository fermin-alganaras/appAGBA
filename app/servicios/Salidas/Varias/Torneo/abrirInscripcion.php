<?php

session_start();

require_once '..\..\..\Controlador\ServidorControladores.php';
require_once '..\..\..\Modelo\Usuario.php';

if (isset($_SESSION['user'])) {
    $us = unserialize($_SESSION['user']);
    if (isset($_POST['idTorneo'])) {
        if ($us->getTipo() == 'admin') {
            $s = ServidorControladores::getConTorneo()->abrirInscripcion($_POST['idTorneo']);
            echo json_encode($s);
        }
    }
}

