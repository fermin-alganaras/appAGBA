<?php
session_start();

require_once ('..\..\..\Controlador\ServidorControladores.php');
require_once ('..\..\..\Modelo\Usuario.php');

$cPat= ServidorControladores::getConPatinador();
$user=  unserialize($_SESSION['user']);
if ($user) {
    $ids= Array();
    if ($user->getTipo()=='club') {
        $datos=  json_decode($_POST['patinadores']);
        foreach ($datos as $patinador) {
            $b=$cPat->insertarPatinador($patinador->apellido, $patinador->nombre, $patinador->dni,
                    ServidorControladores::invertirFecha($patinador->fNacimiento), $patinador->sexo, $patinador->nacionalidad,
                    false, date(DATE_W3C), $user->getClub()->getIdClub(),
                    $patinador->domicilio->direccion, $patinador->domicilio->cp,
                    $patinador->domicilio->telefono, $patinador->domicilio->localidad, $patinador->domicilio->provincia, 
                    $patinador->idCatEsc, $patinador->idCatLibr, $patinador->idCatSoloDance, $patinador->idCatFreeDance);
                if($b!=false){
                    array_push($ids, $b);
                }
        }
        echo json_encode($ids);

    }else{
        $datos=  json_decode($_POST['patinadores']);
        foreach ($datos as $patinador) {
                $b=$cPat->insertarPatinador($patinador->apellido, $patinador->nombre, $patinador->dni,
                        ServidorControladores::invertirFecha($patinador->fNacimiento), $patinador->sexo, 
                        $patinador->nacionalidad, false, date(DATE_W3C), $patinador->idClub, 
                        $patinador->domicilio->direccion, $patinador->domicilio->cp, $patinador->domicilio->telefono,
                        $patinador->domicilio->localidad, $patinador->domicilio->provincia,
                        $patinador->idCatEsc, $patinador->idCatLibr, $patinador->idCatSoloDance, $patinador->idCatFreeDance);
                if($b!=false){
                    $pat=ServidorControladores::getConPatinador()->traerPatinadorXID($b);
                    $tipoLic= ServidorControladores::getConLicencia()->defineLicencia($pat->getCatEsc(), $pat->getCatLibre(), $pat->getCatSoloDance(), $pat->getCatFreeDance());
                    ServidorControladores::getConPatinador()->creaOHabilitaLicencia($pat, $tipoLic);
                }else{
                    echo json_encode($b);
                }
        }
        echo 'true';
    }
}
