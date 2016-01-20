<?php
session_start();

require_once '..\..\..\Controlador\ServidorControladores.php';
require_once '..\..\..\Modelo\Usuario.php';

if (isset($_SESSION['user'])) {
try{
    $us= unserialize($_SESSION['user']);
    if($us->getTipo()=='admin'){
        $l= ServidorControladores::getConListaBnaFe()->traerLista($_GET['idLista']);
        $excel= ServidorControladores::getConReportes()->exportarLista($l);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Cache-Control: max-age=0');
        $exList= PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        //$dir=ServidorControladores::getConClub()->traerClubXID($l->getClub())->getNombre().'-'.ServidorControladores::getConTorneo()->traerTorneoXID($l->getTorneo())->getDenominacion().'.xlsx"';
        $exList->save('php://output');
        
        exit();
    }else{
        $l= ServidorControladores::getConListaBnaFe()->traerLista($_GET['idLista']);
        $excel= ServidorControladores::getConReportes()->exportarLista($l);
        $exList= PHPExcel_IOFactory::createWriter($excel, 'PDF');
        header('Content-Type: application/pdf');
        header('Cache-Control: max-age=0');
        $exList->save('php://ouput');
        exit();
    }
}  catch (Exception $ex){
    die ($ex->getMessage(). $ex->getTraceAsString());
}    
} 
