<?php

require_once ('..\..\..\Modelo\Tecnico.php');
require_once ('ControladorGeneral.php');
require_once ('ControladorDomicilio.php');
require_once ('ControladorLicencia.php');
require_once ('ControladorCategoria.php');
require_once ('ControladorClub.php');

class ControladorTecnico {
    private $cDom;
    private $cLic;
    private $cCat;
    private $cClub;
    function __construct() {
        $this->cDom= ServidorControladores::getConDomicilio();
        $this->cLic= ServidorControladores::getConLicencia();
        $this->cCat= ServidorControladores::getConCategoria();
        $this->cClub= ServidorControladores::getConClub();
    }
    
    public function insertarTecnico($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta,
            $idClub, $direccion, $cp, $telefono, $localidad, $provincia, $idCat){
        try{
            ServidorControladores::getConBD()->getConexion()->query("START TRANSACTION");           
            $this->cDom->insertarDomicilio($direccion, $cp, $telefono, $localidad, $provincia);
            $idDomicilio= $this->cDom->traerUltimoID();
            if(!ServidorControladores::getConBD()->getConexion()->query("insert into persona values(null,'$apellido','$nombre','$dni','
                $fNacimiento','$sexo','$nacionalidad','$exportada','$fechaAlta','$idClub','$idDomicilio',null)")){
                die(ServidorControladores::getConBD()->getConexion()->error);
                ServidorControladores::getConBD()->getConexion()->query("ROLLBACK");
            }
            $idP=ServidorControladores::getConBD()->getConexion()->query("SELECT MAX(idPersona) AS id FROM persona")->fetch_array();
            $idPer=$idP['id'];
            
            if(!ServidorControladores::getConBD()->getConexion()->query("insert into tecnico values(null,'$idCat ','$idPer')")){
                    die(ServidorControladores::getConBD()->getConexion()->error);
                    ServidorControladores::getConBD()->getConexion()->query("ROLLBACK");
            }            
            ServidorControladores::getConBD()->getConexion()->query("COMMIT");
            return TRUE;
        }  catch (mysqli_sql_exception $ex){
            ServidorControladores::getConBD()->getConexion()->query("ROLLBACK");
            echo 'Error: '. $ex->getMessage();
            return FALSE;
        }
    }
    
    public function traerTecnicoXID($id){
        $tec=null;
        try{
            $rTec=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM tecnico WHERE idTecnico='$id'");
            while($f= $rTec->fetch_array()){
                $idP=$f['idPersona'];
                $rPer=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM persona WHERE idPersona='$idP'")->fetch_array();
                while($f2= $rPer->fetch_array()){
                    $tec= $this->armarTecnico($f2, $f);
                }
            }
            return $tec;
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
            return null;
        }
    }
    
       
    private function armarTecnico ($rPer, $rPat){
        try{
            $tec= new \Modelo\Tecnico($rPer['apellido'], $rPer['nombre'], $rPer['dni'], $rPer['fNacimiento'],
                    $rPer['sexo'], $rPer['nacionalidad'], $rPer['exportada'], $rPer['idClub'],$rPer['fechaAlta']);
            $tec->setIdTecnico($rPat['idTecnico']);
            $tec->setIdPersona($rPat['idPersona']);
            $tec->setDomicilio($this->cDom->traerDomicilioXID($rPer['idDomicilio']));
            $tec->setLicencia($this->cLic->traerLicenciaXIdPersona($tec->getIdPersona()));
            $tec->setCategoria($this->cCat->traerCategoriaXID($rPat['idCategoria']));
            $tec->setFNacimiento(ServidorControladores::invertirFecha($tec->getFNacimiento()));
            return $tec;
        }  catch (mysqli_sql_exception $ex){
            echo 'Error: ' . $ex->getMessage();
        }
    }
    
    public function listarTodosXClub($idClub){
        $tecnicos_array= array();
        try{
            if ($idClub!=0) {
                 $r1= ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM persona WHERE idClub='$idClub'");
                 while ($f=$r1->fetch_array()) {
                     $idP=$f['idPersona'];
                    $r2=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM tecnico WHERE idPersona='$idP'" );
                    if ($f2=$r2->fetch_array()) {
                        array_push($tecnicos_array, $this->armarTecnico($f, $f2));
                    }
                 }
            }else {
                $r1= ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM persona");
                 while ($f=$r1->fetch_array()) {
                     $idP=$f['idPersona'];
                     $r2=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM tecnico WHERE idPersona='$idP'");
                     while ($f2=$r2->fetch_array()) {
                        array_push($tecnicos_array, $this->armarTecnico($f, $f2));
                    }
                 }
            }
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
        return $tecnicos_array;
    }
    
    public function listarActivosXClub($idClub){
        $tecnicos_array= $this->listarTodosXClub($idClub);
        foreach ($tecnicos_array as $t){
            if (!($t->getLicencia()->getActiva())) {
                unset($t);
            }
        }
        
        return $tecnicos_array;
    }
    
     public function listarNoActivosXClub($idClub){
        $tecnicos_array= $this->listarTodosXClub($idClub);
        foreach ($tecnicos_array as $t){
            if ($t->getLicencia()->getActiva()) {
                unset($t);
            }
        }
        
        return $tecnicos_array;
    }
    
    public function creaOHabilitaLicencia ($idTec, $tipo){
        $tec= $this->traerTecnicoXID($idTec);
        if ($tec->getLicencia()== null) {
            $this->cLic->nuevaLicencia($tipo, 'true');
            $idLic= $this->cLic->traerUltimoId();
            $idP= $tec->getIdPersona();
            ServidorControladores::getConBD()->getConexion->query("UPDATE persona SET idLicencia='$idLic' WHERE idPersona='$idP");
            return true;
        }elseif($tec->getLicencia()->getActiva()==false){
            $this->cLic->habilitaODeshabilita($pat->getLicencia());
            return true;
        }else{
            return false;
        }
    }
}
