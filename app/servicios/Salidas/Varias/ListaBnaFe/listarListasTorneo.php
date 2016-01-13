<?php
session_start();

require_once '..\..\..\Controlador\ServidorControladores.php';

$listas= null;
if (isset($_SESSION['user'])) {
    $idT= $_POST['idTorneo'];
    $listas= ServidorControladores::getConListaBnaFe()->traerListasXTorneo($idT);
}

echo json_decode($listas);
