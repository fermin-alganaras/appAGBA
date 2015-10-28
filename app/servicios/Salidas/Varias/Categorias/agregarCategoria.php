<?php
session_start();

require_once '..\..\..\Modelo\Usuario.php';
require_once '..\..\..\Controlador\ServidorControladores.php';

if(isset($_SESSION['user'])){
    $u= unserialize($_SESSION['user']);
    if ($u->getTipo()=='admin'){
        if (isset($_POST['categoria'])) {
            $datos= json_decode($_POST['categoria']);
            $b=  ServidorControladores::getConCategoria()->agregarCategoria($datos->denominacion, $datos->orden,
                    $datos->modo, $datos->tipoLicencia, $datos->escuela, $datos->libre, $datos->soloDance,
                    $datos->freeDance, $datos->showPresicion, $datos->solista, $datos->pareja, $datos->grupal,
                    $datos->tipoPersona);
            echo json_encode($b);
        }
        
    }
}


