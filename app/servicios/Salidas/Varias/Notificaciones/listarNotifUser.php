<?php
session_start();

require_once '..\..\..\Controlador\ServidorControladores.php';
require_once '..\..\..\Modelo\Usuario.php';

if (isset($_SESSION['user'])) {
    $us= unserialize($_SESSION['user']);
    $notif= ServidorControladores::getConNotificacion()->traerNotifUser($us->getIdUsuario());
    echo json_encode($notif);
}else{
    echo null;
}


