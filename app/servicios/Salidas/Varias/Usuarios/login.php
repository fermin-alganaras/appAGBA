<?php
/**
 * Logueo de usuario. Recibe el json llamado "usuario" por POST
 * Devuelve el usuario. Si no llegase a encontrar un usuario valido, el objeto 
 * user que devuelve es null.
 */
session_start();

require_once '..\..\..\Controlador\ControladorUsuario.php';

$datos= null;
$contrUser= new ControladorUsuario();
$user=null;
$recuerda=null;

if ($_COOKIE['user'] && $_COOKIE['pass']) {
    $datos[0]['user']=$_COOKIE['user'];
    $datos[0]['pass']=$_COOKIE['pass'];
    $datos[0]['recuerda']= false;
}elseif ($_POST['usuario']) {
    $datos= json_decode($_POST['usuario']);
}

if (count($datos)==1) {
    foreach ($datos AS $usuario){
        $user= $contrUser->traerUsuario($usuario['user'], $usuario['pass']);
        $recuerda= $usuario['recuerda'];
    }
    if ($user!=NULL) {
        $_SESSION['usuario']= $user;
        $_SESSION['contrUsuario']= $contrUser;
        if ($recuerda==true) {
            setcookie('user', $user->getUser(), 60*60*24*30);
            setcookie('pass', $user->getPass(), 60*60*24*30);
        }
    }
}

echo  json_encode($user);



