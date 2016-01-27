<?php

session_start();

require_once '..\..\..\Controlador\ServidorControladores.php';

if (isset($_SESSION['user'])){
    if (isset($_POST['idClub'])) {
        $club= ServidorControladores::getConClub()->traerClubXID($_POST['idClub']);
        echo json_encode($club);
    }else{
        echo null;
    }
}else{
    echo null;
}

