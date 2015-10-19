<?php
session_start();

require_once ('..\..\..\Controlador\ServidorControladores.php');
require_once ('..\..\..\Modelo\Usuario.php');

$cPat= ServidorControladores::getConPatinador();
$user=  unserialize($_SESSION['user']);
if ($user) {
    if ($user->getTipo()=='club') {
        $datos=  json_decode($_POST['patinadores']);
        foreach ($datos as $patinador) {
            $b=$cPat->insertarPatinador($patinador->apellido, $patinador->nombre, $patinador->dni,
                    $patinador->fNacimiento, $patinador->sexo, $$patinador->nacionalidad, 
                    false, date(DATE_W3C), $user->getClub()->getIdClub(),
                    $patinador->domicilio->direccion, $patinador->domicilio->cp,
                    $patinador->domicilio->telefono, $patinador->domicilio->localidad, $patinador->domicilio->provincia, 
                    $patinador->idCatEsc, $patinador->idCatLibr, $patinador->idCatDza);
                if($b==false){
                    return false;
                }
        }
        return true;
        
    }else{
        $datos=  json_decode($_POST['patinadores']);
        foreach ($datos as $patinador) {
                $b=$cPat->insertarPatinador($patinador->apellido, $patinador->nombre, $patinador->dni,
                        $patinador->fNacimiento, $patinador->sexo, $patinador->nacionalidad, 
                        false, date(DATE_W3C), $patinador->idClub, $patinador->domicilio->direccion,
                        $patinador->domicilio->cp, $patinador->domicilio->telefono, 
                        $patinador->domicilio->localidad, $patinador->domicilio->provincia, 
                        $patinador->idCatEsc, $patinador->idCatLibr, $patinador->idCatDza);
                if($b==false){
                    return false;
                }
        }
        return true;
    }
}
   


  
