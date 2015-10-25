<?php

session_start();

require_once '..\..\..\Modelo\Usuario.php';
require_once '..\..\..\Controlador\ServidorControladores.php';

if(isset($_SESSION['user'])){
    $u= unserialize($_SESSION['user']);
    if ($u->getTipo()=='admin'){
        if (isset($_POST['idCat'])) {
            $b=  ServidorControladores::getConCategoria()->eliminaCategoria($_POST['idCat']);
            echo json_encode($b);
        }
        
    }
}
