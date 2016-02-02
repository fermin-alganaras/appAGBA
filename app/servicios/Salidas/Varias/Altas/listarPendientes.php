<?php

session_start();

require_once '..\..\..\Modelo\Usuario.php';
require_once '..\..\..\Modelo\Club.php';
require_once '..\..\..\Controlador\ServidorControladores.php';

if (isset($_SESSION['user'])) {
    $us = unserialize($_SESSION['user']);
    if ($us->getTipo() == 'club') {
        $altas = ServidorControladores::getConAlta()->listarPendientes($us->getIdUsuario());
        echo json_encode($altas);
    } else {
        $altas = ServidorControladores::getConAlta()->listarPendientes(0);
        echo json_encode($altas);
    }
}

