<?php
session_start();

require_once '..\..\..\Modelo\Usuario.php';
require_once '..\..\..\Controlador\ServidorControladores.php';

if(isset($_SESSION['user'])){
    $categorias= ServidorControladores::getConCategoria()->traerCategoriasSolistasDanza();
    echo json_encode($categorias);
}

