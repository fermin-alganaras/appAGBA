<?php

require_once ('..\..\..\Modelo\Delegado.php');
require_once ('ControladorGeneral.php');
require_once ('ControladorDomicilio.php');
require_once ('ControladorLicencia.php');
require_once ('ControladorCategoria.php');
require_once ('ControladorClub.php');

class ControladorDelegado extends ControladorGeneral{
    private $cDom;
    private $cLic;
    private $cCat;
    private $cClub;
    function __construct() {
        parent::__construct();
        $this->cDom= ServidorControladores::getConDomicilio();
        $this->cLic= ServidorControladores::getConLicencia();
        $this->cCat= ServidorControladores::getConCategoria();
        $this->cClub= ServidorControladores::getConClub();
    }
    
    public function insertarDelegado($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta,
            $idClub, $direccion, $cp, $telefono, $localidad, $provincia, $email){
        try{
            if(!ServidorControladores::getConBD()->getConexion()->query("START TRANSACTION")){
              die(ServidorControladores::getConBD()->getConexion()->error);
            }
            $this->cDom->insertarDomicilio($direccion, $cp, $telefono, $localidad, $provincia);
            $idDomicilio= $this->cDom->traerUltimoID();
            if(!ServidorControladores::getConBD()->getConexion()->query("insert into persona values(null,'$apellido','$nombre','$dni','
                $fNacimiento','$sexo','$nacionalidad','$exportada','$fechaAlta','$idClub','$idDomicilio',null)")){
                ServidorControladores::getConBD()->getConexion()->query("ROLLBACK");
                die(ServidorControladores::getConBD()->getConexion()->error);
                
            }
            $idP=ServidorControladores::getConBD()->getConexion()->query("SELECT MAX(idPersona) AS id FROM persona")->fetch_array();
            $idPer=$idP['id'];
            
            if(!ServidorControladores::getConBD()->getConexion()->query("insert into delegado values(null,'$email','$idPer')")){
                ServidorControladores::getConBD()->getConexion()->query("ROLLBACK");    
                die(ServidorControladores::getConBD()->getConexion()->error);
                    
            }            
            ServidorControladores::getConBD()->getConexion()->query("COMMIT");
            return TRUE;
        }  catch (mysqli_sql_exception $ex){
            ServidorControladores::getConBD()->getConexion()->query("ROLLBACK");
            echo 'Error: '. $ex->getMessage();
            return FALSE;
        }
    }
    
    public function traerDelegadoXID($id){
        try{
            $rDel=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM delegado WHERE idDelegado='$id'")->fetch_array();
            $idP=$rDel['idPersona'];
            $rPer=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM persona WHERE idPersona='$idP'")->fetch_array();
            
            $del= $this->armarDelegado($rPer, $rDel);
            return $del;
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
            return null;
        }
    }
    
      
    private function armarDelegado ($rPer, $rPat){
        try{
            $del= new \Modelo\Delegado($rPer['apellido'], $rPer['nombre'], $rPer['dni'], $rPer['fNacimiento'],
                    $rPer['sexo'], $rPer['nacionalidad'], $rPer['exportada'], $rPer['fechaAlta'],$rPer['idClub'] ,$rPat['email']);
            $del->setIdDelegado($rPat['idDelegado']);
            $del->setIdPersona($rPat['idPersona']);
            $del->setDomicilio($this->cDom->traerDomicilioXID($rPer['idDomicilio']));
            $del->setLicencia($this->cLic->traerLicenciaXIdPersona($del->getIdPersona()));
            $del->setFNacimiento(ServidorControladores::invertirFecha($del->getFNacimiento()));
            return $del;
        }  catch (mysqli_sql_exception $ex){
            echo 'Error: ' . $ex->getMessage();
        }
    }
    
    public function listarDelegados($idClub){
        $delegado_array= array();
        try{
            if ($idClub!=0) {
                 $r1= ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM persona WHERE idClub='$idClub'");
                 while ($f=$r1->fetch_array()) {
                     $idP=$f['idPersona'];
                     $r2=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM delegado WHERE idPersona='$idP'");
                    if ($f2=$r2->fetch_array()) {
                        array_push($delegado_array, $this->armarDelegado($f, $f2));
                    }
                 }
            }else {
                $r1= ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM persona");
                 while ($f=$r1->fetch_array()) {
                     $idP= $f['idPersona'];
                     $r2=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM delegado WHERE idPersona='$idP'");
                     while ($f2=$r2->fetch_array()) {
                        array_push($delegado_array, $this->armarDelegado($f, $f2));
                    }
                 }
            }
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
        return $delegado_array;
    }
    
    public function listarActivosXClub($idClub){
        $delegado_array= $this->listarDelegados($idClub);
        foreach ($delegado_array as $p){
            if (!($p->getLicencia()->getActiva())) {
                unset($p);
            }
        }
        
        return $delegado_array;
    }
    
     public function listarNoActivosXClub($idClub){
        $delegado_array= $this->listarDelegados($idClub);
        foreach ($delgado_array as $p){
            if ($p->getLicencia()->getActiva()) {
                unset($p);
            }
        }
        
        return $delegado_array;
    }
}
