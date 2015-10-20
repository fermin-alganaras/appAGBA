<?php
/**
 * Logueo de usuario. Recibe el json llamado "usuario" por POST
 * Devuelve el usuario. Si no llegase a encontrar un usuario valido, el objeto
 * user que devuelve es null.
 */
session_start();
error_reporting(0);
require_once '..\..\..\Controlador\ControladorUsuario.php';

$datos= null;
$contrUser= new ControladorUsuario();
$user=null;
$recuerda=null;
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
    //  var_dump($request);

if ($_COOKIE['user'] && $_COOKIE['pass']) {
    $datos[0]['user']=$_COOKIE['user'];
    $datos[0]['pass']=$_COOKIE['pass'];
    $datos[0]['recuerda']= false;
}elseif ($request) {

    $datos= $request;
}else{
  die('hola');
}

if (count($datos)==1) {

    foreach ($datos AS $usuario){
        $user= $contrUser->traerUsuario($usuario->user, $usuario->pass);
        //$recuerda= $usuario['recuerda'];
    }
    if ($user!=NULL) {
        $_SESSION['user']= $user;
        if ($recuerda==true) {
            setcookie('user', $user->getUser(), 60*60*24*30);
            setcookie('pass', $user->getPass(), 60*60*24*30);
        }
    }
}

echo  json_encode($user);
