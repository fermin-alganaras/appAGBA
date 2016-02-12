<?php
session_start();

require_once '..\..\..\Modelo\Usuario.php';
require_once '..\..\..\Controlador\ServidorControladores.php';

if (isset($_SESSION['user'])) {
    $us=unserialize($_SESSION['user']);
    if (isset($_POST['idTorneo']) && $us->getTipo()=='admin') {
        $s=ServidorControladores::getConTorneo()->cerrarInscripcion($_POST['idTorneo']);
        echo json_encode($s);
    }else{
        echo json_encode(0);
    }
    
}  else {
    echo json_encode(0);
}
