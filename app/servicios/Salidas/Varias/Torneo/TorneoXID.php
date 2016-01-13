<?php
session_start();

require_once '..\..\..\Modelo\Torneo.php';
require_once '..\..\..\Modelo\Usuario.php';
require_once '..\..\..\Controlador\ServidorControladores.php';

if (isset($_SESSION['user'])) {
    $user= unserialize($_SESSION['user']);
    $cT= ServidorControladores::getConTorneo();
    $t= $cT->traerTorneoXID($_POST['idTorneo']);
    echo json_encode($t);
}

