<?php
session_start();

require_once '..\..\..\Modelo\Usuario.php';
require_once '..\..\..\Controlador\ServidorControladores.php';

if (isset($_SESSION['user'])) {
    $us=  unserialize($_SESSION['user']);
    if ($us->getTipo()=='admin') {
        $pendientes= array(
            'patinadores'=> ServidorControladores::getConPatinador()->pendientesExportar(),
            'tecnicos'=>ServidorControladores::getConTecnico()->pendientesExportar(),
            'delegados'=>ServidorControladores::getConDelegado()->pendientesExportar(),
        );
        
        echo json_encode($pendientes);
    }
}

