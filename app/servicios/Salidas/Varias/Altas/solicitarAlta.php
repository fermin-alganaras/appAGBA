<?php
/**
 * Esto genera la solicitud alta y genera la notificacion de la solicitud de alta.
 * Solo es para los usuarios tipo club. Tiene que recibir por POST 3 json distintos solo con los id de 
 * patinadores, tecnicos, y delegados que solicitan el alta. Devuelve verdadero si la solicitud se creo correctamente
 * y falso si hubo algun problema y no se completo.
 */
session_start();

require_once ('..\..\..\Controlador\ServidorControladores.php');
require_once ('..\..\..\Modelo\Usuario.php');


$cPat=  ServidorControladores::getConPatinador();
$user=  unserialize($_SESSION['user']);
$cAlt= ServidorControladores::getConAlta();
$idsPat=null;
$idsTec=null;
$idsDel=null;
if ($user) {
    if ($user->getTipo()=='club') {
        if($_POST['idsPat']){
            $idsPat=$_POST['idsPat'];
        }
        if($_POST['idsTec']){
            $idsTec=$_POST['idsTec'];
        }
        if($_POST['idsDel']){
            $idsDel=$_POST['idsDel'];
        }
        $b=$cAlt->nuevaAlta($idsPat, $idsTec, $idsDel, $user->getIdUsuario());
        echo json_encode($b);
    }
}

