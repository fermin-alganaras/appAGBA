<?php

session_start();

require_once '..\..\..\Controlador\ServidorControladores.php';
require_once '..\..\..\Modelo\Usuario.php';

$user= unserialize($_SESSION['user']);
$cTor= ServidorControladores::getConTorneo();
$nT=FALSE;

if ($user->getTipo()== 'admin') {
    $t=  json_decode($_POST['torneo']);
    $nT= $cTor->actualizarTorneo($t->idTorneo, $t->denominacion, ServidorControladores::invertirFecha($t->inicio), 
            ServidorControladores::invertirFecha($t->fin), $t->organiza, $t->marca, $t->anio);
    echo json_encode($nT);
}else{
    echo 'No posee permiso para realizar esta operacion';
}