<?php

session_start();
require_once '..\..\..\Controlador\ServidorControladores.php';
require_once '..\..\..\Modelo\Usuario.php';

if (isset($_SESSION['user'])) {
    $us = unserialize($_SESSION['user']);
    $arrayDatos = array();
    $dat = json_decode($_POST['datos']);
    foreach ($dat as $per) {
        $datos = explode('-', $per);
        $tipo = $datos[0];
        $id = $datos[1];
        if ($tipo == 'p') {
            $pat = ServidorControladores::getConPatinador()->traerPatinadorXID($id);
            array_push($arrayDatos, $pat);
        } elseif ($tipo == 't') {
            $pat = ServidorControladores::getConTecnico()->traerTecnicoXID($id);
            array_push($arrayDatos, $pat);
        } elseif ($tipo == 'd') {
            $pat = ServidorControladores::getConDelegado()->traerDelegadoXID($id);
            array_push($arrayDatos, $pat);
        } else {
            die('error');
        }
    }
    if ($us->getTipo() == 'admin') {
        $excel = ServidorControladores::getConReportes()->exportarPadron($arrayDatos, $us->getIdUsuario());
        $nombre=time(). '- Padron.xls';
        $exList = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Cache-Control: max-age=0');
        header('Content-Disposition: attachment;filename=' . time(). '- Padron.xls');
        $exList->save('..\\..\\..\\Temp\\' . $nombre);
        echo $nombre;
    } else {
        $excel = ServidorControladores::getConReportes()->exportarPadron($arrayDatos);
        $exList = PHPExcel_IOFactory::createWriter($excel, 'PDF');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment;filename=' . ServidorControladores::getConClub() - traerClubXID($l->getIdClub())
                        ->getNombre() . '- Padron.pdf');
        header('Cache-Control: max-age=0');
        $exList->save('php://ouput');
        exit();
    }
}