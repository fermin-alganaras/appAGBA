<?php

session_start();

require_once '..\..\..\Modelo\Usuario.php';
require_once '..\..\..\Modelo\Club.php';

if (isset($_SESSION['user'])) {
    $us= unserialize($_SESSION['user']);
    echo json_encode($us);
}else{
    echo null;
}

