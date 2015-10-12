<?php
session_start();

require_once ('..\..\..\Controlador\ControladorPatinador.php');
require_once ('..\..\..\Controlador\ControladorUsuario.php');

$cPat= new ControladorPatinador;
if ($_SESSION['user']) {
    if ($_SESSION['user']->getClub()->getTipo()=='club') {
        $datos=  json_decode($_POST['patinadores']);
        
        foreach ($datos as $patinador) {
                $b=$cPat->insertarPatinador($patinador['apellido'], $patinador['nombre'], $patinador['dni'],
                        $patinador['fNacimiento'], $patinador['sexo'], $$patinador['nacionalidad'], 
                        false, date(DATE_W3C), $_SESSION['user']->getClub()->getIdClub(),
                        $patinador['domicilio']['direccion'], $patinador['domicilio']['cp'],
                        $patinador['domicilio']['telefono'], $patinador['domicilio']['localidad'], $patinador['domicilio']['localidad'], 
                        $patinador['idCatEsc'], $patinador['idCatLibr'], $patinador['idCatDza']);
                if($b==false){
                    return false;
                }
        }
        return true;
        
    }else{
        $datos=  json_decode($_POST['patinadores']);
        foreach ($datos as $patinador) {
                $b=$cPat->insertarPatinador($patinador['apellido'], $patinador['nombre'], $patinador['dni'],
                        $patinador['fNacimiento'], $patinador['sexo'], $$patinador['nacionalidad'], 
                        false, date(DATE_W3C), $patinador['idClub'], $patinador['domicilio']['direccion'],
                        $patinador['domicilio']['cp'], $patinador['domicilio']['telefono'], 
                        $patinador['domicilio']['localidad'], $patinador['domicilio']['localidad'], 
                        $patinador['idCatEsc'], $patinador['idCatLibr'], $patinador['idCatDza']);
                if($b==false){
                    return false;
                }
        }
        return true;
    }
}
   


  
