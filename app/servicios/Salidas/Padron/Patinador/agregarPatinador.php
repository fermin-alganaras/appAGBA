<?php

include_once ('..\..\..\Controlador\ControladorPatinador.php');



$cPat= new ControladorPatinador;
  
$b=$cPat->insertarPatinador($_POST['apellido'], $_POST['nombre'], $_POST['dni'], $_POST['fNacimiento'],
        $_POST['sexo'], $_POST['nacionalidad'], false, date(DATE_ATOM), 1, $_POST['direccion'], 
        $_POST['cp'], $_POST['telefono'], $_POST['localidad'], $_POST['provincia'], $_POST['esc'],
        $_POST['libr'], $_POST['dza']);

$t=$cPat->listarTodosXClub(1);

echo print_r(json_encode($t));