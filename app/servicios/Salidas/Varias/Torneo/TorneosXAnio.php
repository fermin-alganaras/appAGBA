<?php
session_start();

require_once '..\..\..\Controlador\ServidorControladores.php';

$cTorneo= ServidorControladores::getConTorneo();

if (isset($_SESSION['user'])) {
    $array= $cTorneo->listarTodosXAnio();
    $datos= json_encode($array);
    echo $datos;
}

