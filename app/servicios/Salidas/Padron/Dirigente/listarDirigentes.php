<?php
session_start();
require_once ('..\..\..\Controlador\ServidorControladores.php');

require_once ('..\..\..\Modelo\Usuario.php');

$cDel= ServidorControladores::getConDirigente();
$array_del=null;    
$user=  unserialize($_SESSION['user']);
if ($user) {
  //var_dump($_SESSION['user']);
    if ($user->getTipo()=='admin') {
        $array_del= $cDel->listarDirigentes();
        echo json_encode($array_del);
            
    }else{
        echo 'No tiene permiso para realizar esta operacion';
    }

}
