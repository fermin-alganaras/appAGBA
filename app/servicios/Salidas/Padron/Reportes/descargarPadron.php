<?php

session_start();

require_once '..\..\..\Modelo\Usuario.php';

if (isset($_SESSION['user'])) {
    $archNom = $_GET['a'];
    $enlace = '..\\..\\..\\Temp\\'.$archNom;
    header("Content-Disposition: attachment; filename=$enlace ");
    header("Content-Type: application/force-download");
    header("Content-Length: " . filesize($enlace));
    readfile($enlace);
}


