<?php
session_start();

require_once ('..\..\..\Controlador\ServidorControladores.php');
require_once ('..\..\..\Modelo\Usuario.php');

$cTec= ServidorControladores::getConTecnico();
$user=  unserialize($_SESSION['user']);
if ($user) {
    if ($user->getTipo()=='club') {
        $datos=  json_decode($_POST['tecnicos']);
        foreach ($datos as $tecnico) {
            $b=$cTec->insertarTecnico($tecnico->apellido, $tecnico->nombre, $tecnico->dni,
                    $tecnico->fNacimiento, $tecnico->sexo, $$tecnico->nacionalidad, 
                    false, date(DATE_W3C), $user->getClub()->getIdClub(),
                    $tecnico->domicilio->direccion, $tecnico->domicilio->cp,
                    $tecnico->domicilio->telefono, $tecnico->domicilio->localidad, $tecnico->domicilio->provincia, 
                    $tecnico->idCat);
                if($b==false){
                    return false;
                }
        }
        return true;
        
    }else{
        $datos=  json_decode($_POST['tecnicos']);
        foreach ($datos as $tecnico) {
                $b=$cTec->insertarTecnico($tecnico->apellido, $tecnico->nombre, $tecnico->dni,
                        $tecnico->fNacimiento, $tecnico->sexo, $tecnico->nacionalidad, 
                        false, date(DATE_W3C), $tecnico->idClub, $tecnico->domicilio->direccion,
                        $tecnico->domicilio->cp, $tecnico->domicilio->telefono, 
                        $tecnico->domicilio->localidad, $tecnico->domicilio->provincia, 
                        $tecnico->idCat);
                if($b==false){
                    return false;
                }
        }
        return true;
    }
}
   


  
