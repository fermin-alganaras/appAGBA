<?php

require_once '..\..\..\Controlador\ServidorControladores.php';
require_once '..\..\..\Modelo\Usuario.php';

if (isset($_SESSION['user'])) {
    $us=  unserialize($_SESSION('user'));
    $arrayDatos=array();
    $dat= json_decode($_POST['datos']);
    foreach ($dat as $per) {
        if ($per->tipo==1) {
            $pat= ServidorControladores::getConPatinador()->traerPatinadorXID($per->id);
            array_push($arrayDatos, $pat);
        }elseif($per->tipo==2){
            $pat= ServidorControladores::getConTecnico()->traerTecnicoXID($per->id);
            array_push($arrayDatos, $pat);
        }else{
            $pat= ServidorControladores::getConDelegado()->traerDelegadoXID($per->id);
            array_push($arrayDatos, $pat);
        }
    }
    if($us->getTipo()=='admin'){
        $excel= ServidorControladores::getConReportes()->exportarPadron($arrayDatos);
        $exList= PHPExcel_IOFactory::createWriter($excel, 'Excel 2003');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Cache-Control: max-age=0');
        $exList->save('php://ouput');
        exit();
    }else{
        $excel= ServidorControladores::getConReportes()->exportarPadron($arrayDatos);
        $exList= PHPExcel_IOFactory::createWriter($excel, 'PDF');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment;filename='.ServidorControladores::getConClub()-traerClubXID($l->getIdClub())
            ->getNombre().'- Padron.pdf');
        header('Cache-Control: max-age=0');
        $exList->save('php://ouput');
        exit();
    }
}