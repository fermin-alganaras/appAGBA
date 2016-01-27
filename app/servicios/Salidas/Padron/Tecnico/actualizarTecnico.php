<?php

session_start();

require_once ('..\..\..\Controlador\ServidorControladores.php');
require_once ('..\..\..\Modelo\Usuario.php');


if (isset($_SESSION['user'])) {
        $datos=  json_decode($_POST['tecnico']);
        $p= ServidorControladores::getConTecnico()->traerTecnicoXID($datos->idTecnico);
        $p->apellido=$datos->apellido;
        $p->nombre = $datos->nombre;
        $p->dni=$datos->dni;
        $p->fNacimiento = ServidorControladores::invertirFecha($datos->fNacimiento);
        $p->domicilio->direccion= $datos->domicilio->direccion;
        $p->domicilio->cp=$datos->domicilio->cp;
        $p->domicilio->localidad = $datos->domicilio->localidad;
        $p->domicilio->provincia =$datos->domicilio->provincia;
        $p->domicilio->telefono =$datos->domicilio->telefono;
        $b= ServidorControladores::getConTecnico()->actualizarTecnico($p);
        if ($b) {
            echo 1;
        }else{
            echo 0;
        }
}

