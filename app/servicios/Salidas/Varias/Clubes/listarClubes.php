<?php
/**
 * Lista todo los clubes de la base de datos
 */
session_start();

require_once '..\..\..\Modelo\Usuario.php';
require_once '..\..\..\Controlador\ServidorControladores.php';

$user= unserialize($_SESSION['user']);

if ($user->getTipo()=='admin') {
    echo json_encode(ServidorControladores::getConClub()->listarClubes());
}else{
    echo 'No tienen permiso para esta accion';
}
