<?php
require_once '..\..\..\PHPExcel_1.8.0_doc\Classes\PHPExcel.php';
require_once '..\..\..\PHPExcel_1.8.0_doc\Classes\PHPExcel\Writer\Excel5.php';

class ControladorReportes {
    
    private $cClub;
    private $cPat;
    private $cLic;
    private $cCat;
    
    function __construct() {
        $this->cClub= ServidorControladores::getConClub();
        $this->cCat= ServidorControladores::getConCategoria();
        $this->cLic= ServidorControladores::getConLicencia();
        $this->cPat=  ServidorControladores::getConPatinador();
    }

    
    public function exportarPadron(array $datos, $idClub ){
        $padronExcel= new PHPExcel();
        $nFila=3;
        
        $padronExcel->getProperties()
                ->setTitle('Padron'.time().$this->cClub->getClubXID($idClub)->getNombre());
        
        $padronExcel->addSheet(0);
        $padronExcel->setActiveSheetIndex(0)
                ->setCellValue('B2', 'Lic Nacional Nª')
                ->setCellValue('C2', 'DNI Nº')
                ->setCellValue('D2', 'Apellido')
                ->setCellValue('E2', 'Nombre')
                ->setCellValue('F2', 'Fecha de Nacimiento')
                ->setCellValue('G2', 'Sexo')
                ->setCellValue('H2', 'Nacionalidad')
                ->setCellValue('I2', 'Categoria')
                ->setCellValue('J2', 'Domicilio')
                ->setCellValue('K2', 'CP')
                ->setCellValue('L2', 'Localidad')
                ->setCellValue('M2', 'Provincia')
                ->setCellValue('N2', 'Telefono')
                ->setCellValue('O2', 'Tipo Licencia');
            $padronExcel->getActiveSheet()->getCell('B2')->getStyle()->applyFromArray($this->formatoTitulos());
            $padronExcel->getActiveSheet()->getCell('C2')->getStyle()->applyFromArray($this->formatoTitulos());
            $padronExcel->getActiveSheet()->getCell('D2')->getStyle()->applyFromArray($this->formatoTitulos());
            $padronExcel->getActiveSheet()->getCell('E2')->getStyle()->applyFromArray($this->formatoTitulos());
            $padronExcel->getActiveSheet()->getCell('F2')->getStyle()->applyFromArray($this->formatoTitulos());
            $padronExcel->getActiveSheet()->getCell('G2')->getStyle()->applyFromArray($this->formatoTitulos());
            $padronExcel->getActiveSheet()->getCell('H2')->getStyle()->applyFromArray($this->formatoTitulos());
            $padronExcel->getActiveSheet()->getCell('I2')->getStyle()->applyFromArray($this->formatoTitulos());
            $padronExcel->getActiveSheet()->getCell('J2')->getStyle()->applyFromArray($this->formatoTitulos());
            $padronExcel->getActiveSheet()->getCell('K2')->getStyle()->applyFromArray($this->formatoTitulos());
            $padronExcel->getActiveSheet()->getCell('L2')->getStyle()->applyFromArray($this->formatoTitulos());
            $padronExcel->getActiveSheet()->getCell('M2')->getStyle()->applyFromArray($this->formatoTitulos());
            $padronExcel->getActiveSheet()->getCell('N2')->getStyle()->applyFromArray($this->formatoTitulos());
            $padronExcel->getActiveSheet()->getCell('O2')->getStyle()->applyFromArray($this->formatoTitulos());    
        
                
        foreach ($datos as $fila) {
            if ($fila instanceof Modelo\Patinador){
                $padronExcel->setActiveSheetIndex(0)
                ->setCellValue('B'.$nFila, $fila->getLicencia()->getNumero())
                ->setCellValue('C'.$nFila, $fila->getDni())
                ->setCellValue('D'.$nFila, $fila->getApellido())
                ->setCellValue('E'.$nFila, $fila->getNombre())
                ->setCellValue('F'.$nFila, ServidorControladores::invertirFecha($fila->getFNacimiento()))
                ->setCellValue('G'.$nFila, $fila->getSexo())
                ->setCellValue('H'.$nFila, $fila->getNacionalidad())
                ->setCellValue('I'.$nFila, ServidorControladores::getConCategoria()->defineCat($fila))
                ->setCellValue('J'.$nFila, $fila->getDomicilio()->getDireccion())
                ->setCellValue('K'.$nFila, $fila->getDomicilio()->getCP())
                ->setCellValue('L'.$nFila, $fila->getDomicilio()->getLocalidad())
                ->setCellValue('M'.$nFila, $fila->getDomicilio()->getProvincia())
                ->setCellValue('N'.$nFila, $fila->getDomicilio()->getTelefono())
                ->setCellValue('O'.$nFila, $fila->getLicencia()->getTipo());
                $padronExcel->getActiveSheet()->getCell('B'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('C'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('D'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('E'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('F'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('G'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('H'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('I'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('J'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('K'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('L'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('M'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('N'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('O'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $nFila++;
            }elseif($fila instanceof Modelo\Delegado){
                $padronExcel->setActiveSheetIndex(0)
                ->setCellValue('B'.$nFila, $fila->getLicencia()->getNumero())
                ->setCellValue('C'.$nFila, $fila->getDni())
                ->setCellValue('D'.$nFila, $fila->getApellido())
                ->setCellValue('E'.$nFila, $fila->getNombre())
                ->setCellValue('F'.$nFila, ServidorControladores::invertirFecha($fila->getFNacimiento()))
                ->setCellValue('G'.$nFila, $fila->getSexo())
                ->setCellValue('H'.$nFila, $fila->getNacionalidad())
                ->setCellValue('I'.$nFila, 'DELEGADO')
                ->setCellValue('J'.$nFila, $fila->getDomicilio()->getDireccion())
                ->setCellValue('K'.$nFila, $fila->getDomicilio()->getCP())
                ->setCellValue('L'.$nFila, $fila->getDomicilio()->getLocalidad())
                ->setCellValue('M'.$nFila, $fila->getDomicilio()->getProvincia())
                ->setCellValue('N'.$nFila, $fila->getDomicilio()->getTelefono())
                ->setCellValue('O'.$nFila, $fila->getLicencia()->getTipo());
                $padronExcel->getActiveSheet()->getCell('B'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('C'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('D'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('E'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('F'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('G'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('H'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('I'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('J'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('K'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('L'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('M'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('N'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('O'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $nFila++;
            }else{
                $padronExcel->setActiveSheetIndex(0)
                ->setCellValue('B'.$nFila, $fila->getLicencia()->getNumero())
                ->setCellValue('C'.$nFila, $fila->getDni())
                ->setCellValue('D'.$nFila, $fila->getApellido())
                ->setCellValue('E'.$nFila, $fila->getNombre())
                ->setCellValue('F'.$nFila, ServidorControladores::invertirFecha($fila->getFNacimiento()))
                ->setCellValue('G'.$nFila, $fila->getSexo())
                ->setCellValue('H'.$nFila, $fila->getNacionalidad())
                ->setCellValue('I'.$nFila, $fila->getCategoria())
                ->setCellValue('J'.$nFila, $fila->getDomicilio()->getDireccion())
                ->setCellValue('K'.$nFila, $fila->getDomicilio()->getCP())
                ->setCellValue('L'.$nFila, $fila->getDomicilio()->getLocalidad())
                ->setCellValue('M'.$nFila, $fila->getDomicilio()->getProvincia())
                ->setCellValue('N'.$nFila, $fila->getDomicilio()->getTelefono())
                ->setCellValue('O'.$nFila, $fila->getLicencia()->getTipo());
                $padronExcel->getActiveSheet()->getCell('B'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('C'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('D'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('E'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('F'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('G'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('H'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('I'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('J'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('K'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('L'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('M'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('N'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $padronExcel->getActiveSheet()->getCell('O'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $nFila++;
            }
        }
        return $padronExcel;
        
    }
    
    public function exportarLista(Modelo\ListaBnaFe $lista){
        $listaExcel= new PHPExcel();
        $nFila=12;
        
        $listaExcel->getProperties()->setTitle(ServidorControladores::getConTorneo()->traerTorneoXID($lista->getTorneo())->getDenominacion().'/'. ServidorControladores::getConClub()->traerClubXID($lista->getClub())->getNombre());
        
               
        $listaExcel->setActiveSheetIndex(0);
        $listaExcel->getActiveSheet()->setCellValue('B1', 'Asociacion Regional de Patin Gran Buenos Aires');
        $listaExcel->getActiveSheet()->getCell('B1')->getStyle()->applyFromArray($this->formatoTitulos());
        $listaExcel->getActiveSheet()->mergeCells('B1:I1');
        $listaExcel->getActiveSheet()->setCellValue('B3', 'Fecha de Emision');
        $listaExcel->getActiveSheet()->getCell('B3')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->setCellValue('C3', date('j') .' de '. $this->mesActual() .' '. date('Y'));
        $listaExcel->getActiveSheet()->getCell('C3')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->mergeCells('C3:I3');
        $listaExcel->getActiveSheet()->setCellValue('B4', 'Club/ Entidad');
        $listaExcel->getActiveSheet()->getCell('B4')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->setCellValue('C4', ServidorControladores::getConClub()->traerClubXID($lista->getClub())->getNombre());
        $listaExcel->getActiveSheet()->getCell('C4')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->mergeCells('C4:I4');
        $listaExcel->getActiveSheet()->setCellValue('B5', 'Campeonato/ Torneo');
        $listaExcel->getActiveSheet()->getCell('B5')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->setCellValue('C5', ServidorControladores::getConTorneo()->traerTorneoXID($lista->getTorneo())->getDenominacion());
        $listaExcel->getActiveSheet()->getCell('C5')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->mergeCells('C5:I5');
        $listaExcel->getActiveSheet()->setCellValue('B6', 'Fecha de Realizacion');
        $listaExcel->getActiveSheet()->getCell('B6')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->setCellValue('C6', ServidorControladores::invertirFecha(ServidorControladores::getConTorneo()->traerTorneoXID($lista->getTorneo())->getFInicio())
                .' al '.ServidorControladores::invertirFecha(ServidorControladores::getConTorneo()->traerTorneoXID($lista->getTorneo())->getFFin()));
        $listaExcel->getActiveSheet()->getCell('C6')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->mergeCells('C6:I6');
        $listaExcel->getActiveSheet()->setCellValue('B7', 'Modalidad');
        $listaExcel->getActiveSheet()->getCell('B7')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->setCellValue('C7', 'Escuela');
        $listaExcel->getActiveSheet()->getCell('C7')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->mergeCells('C7:I7');
        $listaExcel->getActiveSheet()
                ->setCellValue('B11', 'Lic Nacional Nª')
                ->setCellValue('C11', 'DNI Nº')
                ->setCellValue('D11', 'Apellido')
                ->setCellValue('E11', 'Nombre')
                ->setCellValue('F11', 'Fecha de Nacimiento')
                ->setCellValue('G11', 'Sexo')
                ->setCellValue('H11', 'Nacionalidad')
                ->setCellValue('I11', 'Categoria')
                ->setCellValue('J11', 'Esc')
                ->setCellValue('K11', 'Libre')
                ->setCellValue('L11', 'Solo')
                ->setCellValue('M11', 'Free');
                
        $listaExcel->getActiveSheet()->getCell('B11')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->getCell('C11')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->getCell('D11')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->getCell('E11')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->getCell('F11')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->getCell('G11')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->getCell('H11')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->getCell('I11')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->getCell('J11')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->getCell('K11')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->getCell('L11')->getStyle()->applyFromArray($this->formatoNormal());
        $listaExcel->getActiveSheet()->getCell('M11')->getStyle()->applyFromArray($this->formatoNormal());
        
        foreach ($lista->getInfoLista() as $comp) {
            if ($comp instanceof Modelo\ItemListaSolista) {
                $id=$comp->idPatinador;
                $pat= $this->cPat->traerPatinadorXID($id);
                               
                if ($comp->getEsc()==true) {
                    $e='X';
                }else{
                    $e=' ';
                }
                if ($comp->getLibr()==true) {
                    $l='X';
                }else{
                    $l=' ';
                }
                if ($comp->getSolo()==true) {
                    $s='X';
                }else{
                    $s=' ';
                }
                if ($comp->getFree()==true) {
                    $f='X';
                }else{
                    $f=' ';
                }
                $listaExcel->getActiveSheet()->setCellValue('B'.$nFila, $pat->getLicencia()->getNumero());
                    $listaExcel->getActiveSheet()->setCellValue('C'.$nFila, $pat->getDNI());
                    $listaExcel->getActiveSheet()->setCellValue('D'.$nFila, $pat->getApellido());
                    $listaExcel->getActiveSheet()->setCellValue('E'.$nFila, $pat->getNombre());
                    $listaExcel->getActiveSheet()->setCellValue('F'.$nFila, ServidorControladores::invertirFecha($pat->getFNacimiento()));
                    $listaExcel->getActiveSheet()->setCellValue('G'.$nFila, $pat->getSexo());
                    $listaExcel->getActiveSheet()->setCellValue('H'.$nFila, $pat->getNacionalidad());
                    $listaExcel->getActiveSheet()->setCellValue('I'.$nFila, ServidorControladores::getConCategoria()->traerCategoriaXID($comp->getIdCategoria())->getDenominacion());
                    $listaExcel->getActiveSheet()->setCellValue('J'.$nFila, $e);
                    $listaExcel->getActiveSheet()->setCellValue('K'.$nFila, $l);
                    $listaExcel->getActiveSheet()->setCellValue('L'.$nFila, $s);
                    $listaExcel->getActiveSheet()->setCellValue('M'.$nFila, $f);        
                $listaExcel->getActiveSheet()->getCell('B'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('C'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('D'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('E'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('F'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('G'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('H'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('I'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('J'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('K'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('L'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('M'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $nFila++;
            }elseif($comp instanceof Modelo\ItemListaPareja){
                $idD=$comp->getIdPatDam();
                $idC=$comp->getIdPatCab();
                $dam= $this->cPat->traerPatinadorXID($idD);
                $cab= $this->cPat->traerPatinadorXID($idC);
                $e=' ';
                if ($comp->getLibr()==true) {
                    $l='X';
                }else{
                    $l=' ';
                }
                if ($comp->getSolo()==true) {
                    $s='X';
                }else{
                    $s=' ';
                }
                if ($comp->getFree()==true) {
                    $f='X';
                }else{
                    $f=' ';
                }
                $listaExcel->getActiveSheet()
                    ->setCellValue('B'.$nFila, $this->cLic->traerLicenciaXIdPersona($dam->getIdPersona())->getNumero())
                    ->setCellValue('B'.($nFila+1),$this->cLic->traerLicenciaXIdPersona($cab->getIdPersona())->getNumero())    
                    ->setCellValue('C'.$nFila, $dam->getDNI())
                    ->setCellValue('C'.($nFila+1), $cab->getDNI())    
                    ->setCellValue('D'.$nFila, $dam->getApellido())
                    ->setCellValue('D'.($nFila+1), $cab->getApellido())
                    ->setCellValue('E'.$nFila, $dam->getNombre())
                    ->setCellValue('E'.($nFila+1), $cab->getNombre())
                    ->setCellValue('F'.$nFila, ServidorControladores::invertirFecha($dam->getFNacimiento()))
                    ->setCellValue('F'.($nFila+1), ServidorControladores::invertirFecha($cab->getFNacimiento()))
                    ->setCellValue('G'.$nFila, $dam->getSexo())
                    ->setCellValue('G'.($nFila+1), $cab->getSexo())
                    ->setCellValue('H'.$nFila, $dam->getNacionalidad())
                    ->setCellValue('H'.($nFila+1), $cab->getNacionalidad())
                    ->setCellValue('I'.$nFila, ServidorControladores::getConCategoria()->traerCategoriaXID($comp->getIdCategoria()))
                    ->setCellValue('J'.$nFila, $e)
                    ->setCellValue('K'.$nFila, $l)
                    ->setCellValue('L'.$nFila, $s)
                    ->setCellValue('M'.$nFila, $f);        
                $listaExcel->getActiveSheet()->getCell('B'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('C'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('D'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('E'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('F'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('G'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('H'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('I'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('J'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('K'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('L'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('M'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->mergeCells('I'.$nFila.':I'.($nFila+1));
                $listaExcel->getActiveSheet()->mergeCells('J'.$nFila.':J'.($nFila+1));
                $listaExcel->getActiveSheet()->mergeCells('K'.$nFila.':K'.($nFila+1));
                $listaExcel->getActiveSheet()->mergeCells('L'.$nFila.':L'.($nFila+1));
                $listaExcel->getActiveSheet()->mergeCells('M'.$nFila.':M'.($nFila+1));
                
                $nFila=+2;
            }elseif($comp instanceof Modelo\ItemListaGrupal){
                $listaExcel->getActiveSheet()
                    
                    ->setCellValue('D'.$nFila, $comp->getNombreGrupal())
                    ->setCellValue('F'.$nFila, ServidorControladores::invertirFecha($pat->getFNacimiento()))
                    ->setCellValue('I'.$nFila, ServidorControladores::getConCategoria()->traerCategoriaXID($comp->getIdCategoria()))
                    ->setCellValue('J'.$nFila, ' ')
                    ->setCellValue('K'.$nFila, 'X')
                    ->setCellValue('L'.$nFila, ' ')
                    ->setCellValue('M'.$nFila, ' ');        
                $listaExcel->getActiveSheet()->getCell('B'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('C'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('D'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('E'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('F'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('G'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('H'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('I'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('J'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('K'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('L'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $listaExcel->getActiveSheet()->getCell('M'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                $nFila++;
                foreach ($comp->getIdsPatinadores() as $idP) {
                    $pat= ServidorControladores::getConPatinador($idP->id);
                    $listaExcel->getActiveSheet()
                        ->setCellValue('B'.$nFila, $this->cLic->traerLicenciaXIdPersona($pat->getIdPersona())->getNumero())
                        ->setCellValue('C'.$nFila, $pat->getDNI())
                        ->setCellValue('D'.$nFila, $pat->getApellido())
                        ->setCellValue('E'.$nFila, $pat->getNombre())
                        ->setCellValue('F'.$nFila, ServidorControladores::invertirFecha($pat->getFNacimiento()))
                        ->setCellValue('G'.$nFila, $pat->getSexo())
                        ->setCellValue('H'.$nFila, $pat->getNacionalidad());
                    $listaExcel->getActiveSheet()->getCell('B'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('C'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('D'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('E'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('F'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('G'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('H'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('I'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('J'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('K'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('L'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('M'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $nFila++;
                }
            }else{
                if($comp->getTipo()==1){
                    $pat= ServidorControladores::getConTecnico()->traerTecnicoXID($comp->getIdTecDeg());
                
                    $listaExcel->getActiveSheet()
                        ->setCellValue('B'.$nFila, $this->cLic->traerLicenciaXIdPersona($pat->getIdPersona())->getNumero())
                        ->setCellValue('C'.$nFila, $pat->getDNI())
                        ->setCellValue('D'.$nFila, $pat->getApellido())
                        ->setCellValue('E'.$nFila, $pat->getNombre())
                        ->setCellValue('F'.$nFila, ServidorControladores::invertirFecha($pat->getFNacimiento()))
                        ->setCellValue('G'.$nFila, $pat->getSexo())
                        ->setCellValue('H'.$nFila, $pat->getNacionalidad())
                        ->setCellValue('I'.$nFila, ServidorControladores::getConCategoria()->traerCategoriaXID($comp->getIdCategoria()));
                           
                    $listaExcel->getActiveSheet()->getCell('B'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('C'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('D'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('E'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('F'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('G'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('H'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('I'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('J'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('K'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('L'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('M'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $nFila++;
                }else{
                    $pat= ServidorControladores::getConDelegado()->traerDelegadoXID($comp->getIdTecDeg());
                
                    $listaExcel->getActiveSheet()
                        ->setCellValue('B'.$nFila, $this->cLic->traerLicenciaXIdPersona($pat->getIdPersona())->getNumero())
                        ->setCellValue('C'.$nFila, $pat->getDNI())
                        ->setCellValue('D'.$nFila, $pat->getApellido())
                        ->setCellValue('E'.$nFila, $pat->getNombre())
                        ->setCellValue('F'.$nFila, ServidorControladores::invertirFecha($pat->getFNacimiento()))
                        ->setCellValue('G'.$nFila, $pat->getSexo())
                        ->setCellValue('H'.$nFila, $pat->getNacionalidad())
                        ->setCellValue('I'.$nFila, 'Delegado');
                           
                    $listaExcel->getActiveSheet()->getCell('B'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('C'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('D'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('E'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('F'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('G'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('H'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('I'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('J'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('K'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('L'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $listaExcel->getActiveSheet()->getCell('M'.$nFila)->getStyle()->applyFromArray($this->formatoNormal());
                    $nFila++;
                }    
            }
        }
        
        return $listaExcel;
           
    }
    
    private function formatoTitulos(){
        $f=array(
            'borders'=>array(
                'allborders'=>array(
                    'style'=> PHPExcel_Style_Border::BORDER_THIN                    
                )                
            ),
            'font'=> array(
                'name'=> 'Arial',
                'size'=> 12,
                'bold'=> true
            ),
            'alignment'=>array(
                'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical'=> PHPExcel_Style_Alignment::VERTICAL_CENTER
                
                )
        );
        
        return $f;
    }
    
    private function formatoNormal(){
        $f=array(
            'borders'=>array(
                'allborders'=>array(
                    'style'=> PHPExcel_Style_Border::BORDER_THIN                    
                )                
            ),
            'font'=> array(
                'name'=> 'Arial',
                'size'=> 12,
                'bold'=> false
            ),
            'alignment'=>array(
                'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                'vertical'=> PHPExcel_Style_Alignment::VERTICAL_CENTER
                
                )
        );
        
        return $f;
    }
    
    private function mesActual(){
        $m= date('F');
        $mes=null;
        switch($m){
            case 'January':
                $mes='Enero';
                break;
            case 'February':
                $mes='Febrero';
                break;
            case 'March':
                $mes='Marzo';
                break;
            case 'April':
                $mes='Abril';
                break;
            case 'May':
                $mes='Mayo';
                break;
            case 'June':
                $mes='Junio';
                break;
            case 'July':
                $mes='Julio';
                break;
            case 'August':
                $mes='Agosto';
                break;
            case 'September':
                $mes='Septiembre';
                break;
            case 'October':
                $mes='Octubre';
                break;
            case 'November':
                $mes='Noviembre';
                break;
            case 'December':
                $mes='Diciembre';
                break;
        }
        return $mes;
    }
}
