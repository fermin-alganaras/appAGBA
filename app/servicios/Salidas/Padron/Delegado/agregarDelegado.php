<?php
session_start();

require_once ('..\..\..\Controlador\ServidorControladores.php');
require_once ('..\..\..\Modelo\Usuario.php');

$cDel= ServidorControladores::getConDelegado();
$user=  unserialize($_SESSION['user']);
if ($user) {
    $ids= array();
    if ($user->getTipo()=='club') {
        $datos=  json_decode($_POST['delegados']);
        foreach ($datos as $delegado) {
            $b=$cDel->insertarDelegado($delegado->apellido, $delegado->nombre, $delegado->dni,
                    ServidorControladores::invertirFecha($delegado->fNacimiento), $delegado->sexo, $delegado->nacionalidad, 
                    false, date('Y-m-d'), $user->getClub()->getIdClub(),
                    $delegado->domicilio->direccion, $delegado->domicilio->cp,
                    $delegado->domicilio->telefono, $delegado->domicilio->localidad, $delegado->domicilio->provincia, 
                    $delegado->email);
                if($b!=false){
                    array_push($ids, $b);
                }else{
                    echo json_encode($b);
                }
        }
        echo json_encode($ids);
        
    }else{
        $datos=  json_decode($_POST['delegados']);
        foreach ($datos as $delegado) {
                $b=$cDel->insertarDelegado($delegado->apellido, $delegado->nombre, $delegado->dni,
                        ServidorControladores::invertirFecha($delegado->fNacimiento), $delegado->sexo, $delegado->nacionalidad, 
                        false, date('Y-m-d'), $delegado->idClub, $delegado->domicilio->direccion,
                        $delegado->domicilio->cp, $delegado->domicilio->telefono, 
                        $delegado->domicilio->localidad, $delegado->domicilio->provincia, 
                        $delegado->email);
                if($b!=false){
                    $pat=ServidorControladores::getConDelegado()->traerTecnicoXID($b);
                    $tipoLic= 'Delegado';
                    ServidorControladores::getConDelegado()->creaOHabilitaLicencia($pat, $tipo);
                }else{
                    echo json_encode($b);
                }
        }
        echo json_encode($ids);
    }
}
   


  
