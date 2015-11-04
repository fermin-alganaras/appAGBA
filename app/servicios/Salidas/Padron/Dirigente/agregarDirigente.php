<?php

session_start();

require_once ('..\..\..\Controlador\ServidorControladores.php');
require_once ('..\..\..\Modelo\Usuario.php');

$cDir= ServidorControladores::getConDirigente();
$user=  unserialize($_SESSION['user']);
if ($user) {
    if ($user->getTipo()=='admin') {
        $datos=  json_decode($_POST['dirigentes']);
        $b=$cDir->insertarDirigente($datos->apellido, $datos->nombre, $datos->dni,
                    ServidorControladores::invertirFecha($datos->fNacimiento), $datos->sexo, $datos->nacionalidad, 
                    false, date(DATE_W3C), $user->getClub()->getIdClub(),
                    $datos->domicilio->direccion, $datos->domicilio->cp,
                    $datos->domicilio->telefono, $datos->domicilio->localidad, $datos->domicilio->provincia, 
                    $datos->cargo, $datos->email);
        if($b==false){
            echo false;
        }
        echo true;
        
    }else{
        echo 'No tiene permiso para realizar esta accion';
    }
}
