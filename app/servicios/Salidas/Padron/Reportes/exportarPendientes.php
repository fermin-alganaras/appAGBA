<?php

session_start();
require_once '..\..\..\Controlador\ServidorControladores.php';
require_once '..\..\..\Modelo\Usuario.php';

if (isset($_SESSION['user'])) {
    $us = unserialize($_SESSION['user']);
    if ($us->getTipo() == 'admin') {
        
        $arrayDatos = array();
        $pat = ServidorControladores::getConPatinador()->pendientesExportar();
        $tec = ServidorControladores::getConTecnico()->pendientesExportar();
        $del = ServidorControladores::getConDelegado()->pendientesExportar();
        foreach ($pat as $p) {
            array_push($arrayDatos, $p);
        }
        foreach ($tec as $t) {
            array_push($arrayDatos, $t);
        }
        foreach ($del as $d) {
            array_push($arrayDatos, $d);
        }

        $excel = ServidorControladores::getConReportes()->exportarPadron($arrayDatos, $us->getIdUsuario());
        $nombre = time() . '- Padron.xls';
        $exList = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Cache-Control: max-age=0');
        header('Content-Disposition: attachment;filename=' . time() . '- Padron.xls');
        $exList->save('..\\..\\..\\Temp\\' . $nombre);
        ServidorControladores::getConPatinador()->activoDefinitivo();
        echo $nombre;
    }
}

