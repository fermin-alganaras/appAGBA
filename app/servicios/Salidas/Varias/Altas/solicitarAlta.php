<?php
/**
 * Esto genera la solicitud alta y genera la notificacion de la solicitud de alta.
 * Solo es para los usuarios tipo club. Tiene que recibir por POST 1 json con 3 array distintos solo con los id de 
 * patinadores, tecnicos, y delegados que solicitan el alta. Devuelve verdadero si la solicitud se creo correctamente
 * y falso si hubo algun problema y no se completo.
 */
session_start();

require_once ('..\..\..\Controlador\ServidorControladores.php');
require_once ('..\..\..\Modelo\Usuario.php');

if (isset($_SESSION['user'])) {

$user=  unserialize($_SESSION['user']);
$cAlt= ServidorControladores::getConAlta();
$idsPat=null;
$idsTec=null;
$idsDel=null;

    if ($user->getTipo()=='club') {
        if(isset($_POST['datos'])){
            $datos= json_decode($_POST['datos']);
            $idsPat=$datos->patinadores;
            $idsTec=$datos->tecnicos;
            $idsDel=$datos->delegados;
        }
        $b=$cAlt->nuevaAlta($idsPat, $idsTec, $idsDel, $user->getIdUsuario());
        echo json_encode($b);
    }else{
        echo null;
    }
}

