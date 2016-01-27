<?php
session_start();

require_once ('..\..\..\Controlador\ServidorControladores.php');
require_once ('..\..\..\Modelo\Usuario.php');


if (isset($_SESSION['user'])) {
        $datos=  json_decode($_POST['patinador']);
        $p= ServidorControladores::getConPatinador()->traerPatinadorXID($datos->idPatinador);
        $p->setApellido($datos->apellido);
        $p->setNombre($datos->nombre);
        $p->setDni($datos->dni);
        $p->setFNacimiento(ServidorControladores::invertirFecha($datos->fNacimiento));
        $p->getDomicilio()->setDireccion($datos->domicilio->direccion);
        $p->getDomicilio()->setCp($datos->domicilio->cp);
        $p->getDomicilio()->setLocalidad($datos->domicilio->localidad);
        $p->getDomicilio()->setProvincia($datos->domicilio->provincia);
        $p->getDomicilio()->setTelefono($datos->domicilio->telefono);
        $b= ServidorControladores::getConPatinador()->actualizarPatinador($p);
        if ($b== true) {
            echo 1;
        }else{
            echo 0;
        }
}

