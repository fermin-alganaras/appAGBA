<?php
session_start();

require_once '..\..\..\Controlador\ServidorControladores.php';

$cTorneo= ServidorControladores::getConTorneo();
$anio= $_POST["anio"];
if (isset($_SESSION['user'])) {
    $array= $cTorneo->listarTodosXAnio($anio);
    $datos= json_encode($array);
    echo $datos;
}

