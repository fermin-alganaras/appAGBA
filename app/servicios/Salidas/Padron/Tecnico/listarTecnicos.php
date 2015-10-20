<?php
session_start();

require_once ('..\..\..\Controlador\ServidorControladores.php');

require_once ('..\..\..\Modelo\Usuario.php');

$cTec= ServidorControladores::getConTecnico();
$array_pat=null;    
$user=  unserialize($_SESSION['user']);
if ($user) {
  //var_dump($_SESSION['user']);
    if ($user->getTipo()=='club') {
        if ($user->getClub()->getIdClub()== $_POST['idClub']) {
            $array_pat= $cTec->listarTodosXClub($_POST['idClub']);
        }else{
            return null;
        }
    }elseif ($user->getTipo()=='admin'){
        $array_pat= $cTec->listarTodosXClub($_POST['idClub']);
    }else{
        return null;
    }

}
echo json_encode($array_pat);
