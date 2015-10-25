<?php

require_once ('..\..\..\Modelo\Dirigente.php');
require_once ('ServidorControladores.php');
require_once ('ControladorDomicilio.php');
require_once ('ControladorLicencia.php');
require_once ('ControladorCategoria.php');
require_once ('ControladorClub.php');

class ControladorDirigente {
    private $cDom;
    private $cLic;
    private $cClub;
    function __construct() {
        $this->cDom= ServidorControladores::getConDomicilio();
        $this->cLic= ServidorControladores::getConLicencia();
        $this->cClub= ServidorControladores::getConClub();
    }
    
    public function insertarDirigente($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta,
            $idClub, $direccion, $cp, $telefono, $localidad, $provincia, $cargo, $email){
        try{
            if(!ServidorControladores::getConBD()->getConexion()->query("START TRANSACTION")){
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            $this->cDom->insertarDomicilio($direccion, $cp, $telefono, $localidad, $provincia);
            $idDomicilio= $this->cDom->traerUltimoID();
            if(!ServidorControladores::getConBD()->getConexion()->query("insert into persona values(null,'$apellido','$nombre','$dni','
                $fNacimiento','$sexo','$nacionalidad','$exportada','$fechaAlta','$idClub','$idDomicilio',null)")){
                die(ServidorControladores::getConBD()->getConexion()->error);
                ServidorControladores::getConBD()->getConexion()->query("ROLLBACK");
            }
            $idP=ServidorControladores::getConBD()->getConexion()->query("SELECT MAX(idPersona) AS id FROM persona")->fetch_array();
            $idPer=$idP['id'];
            
            if(!ServidorControladores::getConBD()->getConexion()->query("insert into dirigente values(null,'$cargo','$email','$idPer')")){
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
    
    public function traerDirigenteXID($id){
        try{
            $rDir=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM dirigente WHERE idDirigente='$id'")->fetch_array();
            $idP=$rDir['idPersona'];
            $rPer=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM persona WHERE idPersona='$idP'")->fetch_array();
            
            $dir= $this->armarDelegado($rPer, $rDir);
            return $dir;
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
            return null;
        }
    }
    
    private function armarDirigente ($rPer, $rPat){
        try{
            $dir= new \Modelo\Dirigente($rPer['apellido'], $rPer['nombre'], $rPer['dni'], $rPer['fNacimiento'],
                    $rPer['sexo'], $rPer['nacionalidad'], $rPer['exportada'], $rPer['fechaAlta'], $rPat['cargo'], 
                    $rPat['email'], $rPer['idClub']);
            $dir->setIdDirigente($rPat['idDirigente']);
            $dir->setIdPersona($rPat['idPersona']);
            $dir->setDomicilio($this->cDom->traerDomicilioXID($rPer['idDomicilio']));
            $dir->setLicencia($this->cLic->traerLicenciaXIdPersona($dir->getIdPersona()));
            return $dir;
        }  catch (mysqli_sql_exception $ex){
            echo 'Error: ' . $ex->getMessage();
        }
    }
    
    public function listarDirigentes(){
        $dirigente_array= array();
        try{
                $r1= ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM persona");
                while ($f=$r1->fetch_array()) {
                     $idP=$f['idPersona'];
                     $r2=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM dirigente WHERE idPersona='$idP'");
                   if ($f2=$r2->fetch_array()) {
                        array_push($dirigente_array, $this->armarDirigente($f, $f2));
                   }
                }
            
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
        return $dirigente_array;
    }
    
    public function listarActivosXClub($idClub){
        $dirigentes_array= $this->listarDirigentes($idClub);
        foreach ($dirigentes_array as $d){
            if (!($d->getLicencia()->getActiva())) {
                unset($d);
            }
        }
        
        return $dirigentes_array;
    }
    
     public function listarNoActivosXClub($idClub){
        $dirigentes_array= $this->listarDirigentes($idClub);
        foreach ($dirigentes_array as $d){
            if ($d->getLicencia()->getActiva()) {
                unset($d);
            }
        }
        
        return $dirigentes_array;
    }
}
