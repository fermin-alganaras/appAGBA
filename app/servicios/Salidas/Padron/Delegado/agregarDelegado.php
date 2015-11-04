<?php
session_start();

require_once ('..\..\..\Controlador\ServidorControladores.php');
require_once ('..\..\..\Modelo\Usuario.php');

$cDel= ServidorControladores::getConDelegado();
$user=  unserialize($_SESSION['user']);
if ($user) {
    if ($user->getTipo()=='club') {
        $datos=  json_decode($_POST['delegados']);
        foreach ($datos as $delegado) {
            $b=$cDel->insertarDelegado($delegado->apellido, $delegado->nombre, $delegado->dni,
                    ServidorControladores::invertirFecha($delegado->fNacimiento), $delegado->sexo, $$delegado->nacionalidad, 
                    false, date(DATE_W3C), $user->getClub()->getIdClub(),
                    $delegado->domicilio->direccion, $delegado->domicilio->cp,
                    $delegado->domicilio->telefono, $delegado->domicilio->localidad, $delegado->domicilio->provincia, 
                    $delegado->email);
                if($b==false){
                    return false;
                }
        }
        return true;
        
    }else{
        $datos=  json_decode($_POST['delegados']);
        foreach ($datos as $delegado) {
                $b=$cDel->insertarDelegado($delegado->apellido, $delegado->nombre, $delegado->dni,
                        ServidorControladores::invertirFecha($delegado->fNacimiento), $delegado->sexo, $delegado->nacionalidad, 
                        false, date(DATE_W3C), $delegado->idClub, $delegado->domicilio->direccion,
                        $delegado->domicilio->cp, $delegado->domicilio->telefono, 
                        $delegado->domicilio->localidad, $delegado->domicilio->provincia, 
                        $delegado->email);
                if($b==false){
                    return false;
                }
        }
        return true;
    }
}
   


  
