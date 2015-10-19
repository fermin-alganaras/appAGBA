<?php
/**
 * Logueo de usuario. Recibe el json llamado "usuario" por POST
 * Devuelve el usuario. Si no llegase a encontrar un usuario valido, el objeto
 * user que devuelve es null.
 */
session_start();
//error_reporting(0);
require_once '..\..\..\Controlador\ServidorControladores.php';

$contrUser= ServidorControladores::getConUsuario();
$us=null;

if ($_POST['user'] && $_POST['pass']) {
    $us= $contrUser->traerUsuario($_POST['user'], $_POST['pass']);
    $us->setPass('');
    if ($us!=NULL) {
        $_SESSION['user']= serialize($us);
    }
}else{
  die('hola');
}

echo  json_encode($us);
