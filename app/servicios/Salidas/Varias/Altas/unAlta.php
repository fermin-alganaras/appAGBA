<?php
session_start();

require_once '..\..\..\Modelo\Usuario.php';
require_once '..\..\..\Modelo\Club.php';
require_once '..\..\..\Controlador\ServidorControladores.php';

if (isset($_SESSION['user'])) {
       $altas = ServidorControladores::getConAlta()->traerAltaXID($_POST['id']);
        echo json_encode($altas);
    
}
