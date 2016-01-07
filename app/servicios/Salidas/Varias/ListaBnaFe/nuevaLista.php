<?php
session_start();

require_once '..\..\..\Controlador\ServidorControladores.php';

if (isset($_SESSION['user'])) {
    $lista= json_decode($_POST['lista']);
    $cLis= ServidorControladores::getConListaBnaFe();
    $b=$cLis->nuevaLista($lista->idClub, time(), $lista->idTorneo, $lista->solistas, $lista->parejas, $lista->grupales, $lista->tecDeg);
    echo $b;
}else{
    echo 'Inicie sesion';
}


