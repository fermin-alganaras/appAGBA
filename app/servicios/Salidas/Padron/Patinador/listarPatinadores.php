<?php
session_start();

require_once ('..\..\..\Controlador\ControladorPatinador.php');
require_once ('..\..\..\Controlador\ControladorUsuario.php');

$cPat= new ControladorPatinador;
$array_pat=null;
if ($_SESSION['user']) {
    if ($_SESSION['user']->getTipo()=='club') {

        if ($_SESSION['user']->getClub()->getIdClub()== $_POST['idClub']) {
            $array_pat= $cPat->listarTodosXClub($_POST['idClub']);
        }else{
            return null;
        }
    }elseif ($_SESSION['user']->getTipo()=='admin'){
        $array_pat= $cPat->listarTodosXClub($_POST['idClub']);
    }else{
        return null;
    }

}
echo json_encode($array_pat);
