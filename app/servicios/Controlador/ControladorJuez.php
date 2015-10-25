<?php

require_once ('..\..\..\Modelo\Juez.php');
require_once ('ServidorControladores.php');
require_once ('ControladorDomicilio.php');
require_once ('ControladorLicencia.php');
require_once ('ControladorCategoria.php');
require_once ('ControladorClub.php');

class ControladorJuez extends \Modelo\Persona{
    private $cDom;
    private $cLic;
    private $cClub;
    function __construct() {
        $this->cDom= ServidorControladores::getConDomicilio();
        $this->cLic= ServidorControladores::getConLicencia();
        $this->cClub= ServidorControladores::getConClub();
    }
    
    public function insertarJuez($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta,
            $idClub, $direccion, $cp, $telefono, $localidad, $provincia, $idCat){
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
            
            if(!ServidorControladores::getConBD()->getConexion()->query("insert into juez values(null,'$idCat','$idPer')")){
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
    
    public function traerJuezXID($id){
        try{
            $rJue=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM juez WHERE idDirigente='$id'")->fetch_array();
            $idP=$rDir['idPersona'];
            $rPer=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM persona WHERE idPersona='$idP'")->fetch_array();
            
            $jue= $this->armarJuez($rPer, $rJue);
            return $jue;
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
            return null;
        }
    }
    
    private function armarJuez ($rPer, $rPat){
        try{
            $jue= new \Modelo\Juez ($rPer['apellido'], $rPer['nombre'], $rPer['dni'], $rPer['fNacimiento'],
                    $rPer['sexo'], $rPer['nacionalidad'], $rPer['exportada'], $rPer['fechaAlta'], $rPer['idClub']);
            $jue->setIdJuez($rPat['idJuez']);
            $jue->setIdPersona($rPat['idPer']);
            $jue->setDomicilio($this->cDom->traerDomicilioXID($rPer['idDomicilio']));
            $jue->setLicencia($this->cLic->traerLicenciaXIdPersona($jue->getIdPersona()));
            $jue->setCategoria(ServidorControladores::getConCategoria()->traerCategoriaXID($rPat['idCategoria']));
            return $jue;
        }  catch (mysqli_sql_exception $ex){
            echo 'Error: ' . $ex->getMessage();
        }
    }
    
    public function listarJueces(){
        $dirigente_array= array();
        try{
                $r1= ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM persona");
                while ($f=$r1->fetch_array()) {
                     $idP=$f['idPersona'];
                     $r2=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM juez WHERE idPer='$idP'");
                   if ($f2=$r2->fetch_array()) {
                        array_push($dirigente_array, $this->armarJuez($f, $f2));
                   }
                }
            
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
        return $dirigente_array;
    }
    
   
}
