<?php
/**
 * Logueo de usuario. Recibe el json llamado "usuario" por POST
 * Devuelve el usuario. Si no llegase a encontrar un usuario valido, el objeto
 * user que devuelve es null.
 */
session_start();
//error_reporting(0);
require_once '..\..\..\Controlador\ServidorControladores.php';


$contrUser = ServidorControladores::getConUsuario();
$us=null;

if (isset($_POST['usuario'])) {

    $datos= json_decode($_POST['usuario']);

    $us= $contrUser->traerUsuario($datos->user, $datos->pass);
    
    if ($us!=NULL) {
        $_SESSION['user']= serialize($us);
        $us->setPass('');
    }
    echo  json_encode($us);
}else{
  die('hola');
}


