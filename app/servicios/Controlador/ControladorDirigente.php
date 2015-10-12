<?php

require_once ('..\..\..\Modelo\Dirigente.php');
require_once ('ControladorGeneral.php');
require_once ('ControladorDomicilio.php');
require_once ('ControladorLicencia.php');
require_once ('ControladorCategoria.php');
require_once ('ControladorClub.php');

class ControladorDirigente extends \Modelo\Persona{
    private $cDom;
    private $cLic;
    private $cClub;
    function __construct() {
        parent::__construct();
        $this->cDom= new ControladorDomicilio;
        $this->cLic= new ControladorLicencia;
        $this->cClub= new ControladorClub;
    }
    
    public function insertarDirigente($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta,
            $idClub, $direccion, $cp, $telefono, $localidad, $provincia, $cargo){
        try{
            if(static::$bd->getConexion()->query("START TRANSACTION")){
                echo 'Se inicio transaccion \n';
            }else {
                echo 'No se inicio transaccion';
            }
            $this->cDom->insertarDomicilio($direccion, $cp, $telefono, $localidad, $provincia);
            $idDomicilio= $this->cDom->traerUltimoID();
            if(!static::$bd->getConexion()->query("insert into persona values(null,'$apellido','$nombre','$dni','
                $fNacimiento','$sexo','$nacionalidad','$exportada','$fechaAlta','$idClub','$idDomicilio',null)")){
                die(static::$bd->getConexion()->error);
                static::$bd->getConexion()->query("ROLLBACK");
            }
            $idP=static::$bd->getConexion()->query("SELECT MAX(idPersona) AS id FROM persona")->fetch_array();
            $idPer=$idP['id'];
            
            if(!static::$bd->getConexion()->query("insert into dirigente values(null,'$cargo','$idPer')")){
                    die(static::$bd->getConexion()->error);
                    static::$bd->getConexion()->query("ROLLBACK");
            }            
            static::$bd->getConexion()->query("COMMIT");
            return TRUE;
        }  catch (mysqli_sql_exception $ex){
            static::$bd->getConexion()->query("ROLLBACK");
            echo 'Error: '. $ex->getMessage();
            return FALSE;
        }
    }
    
    public function traerDirigenteXID(int $id){
        try{
            $rDir=  static::$bd->getConexion()->query("SELECT * FROM dirigente WHERE idDirigente='$id")->fetch_array();
            $idP=$rDir['idPersona'];
            $rPer=  static::$bd->getConexion()->query("SELECT * FROM persona WHERE idPersona='$idP")->fetch_array();
            
            $dir= $this->armarDelegado($rPer, $rDir);
            return $dir;
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
            return null;
        }
    }
    
    private function dirigente ($rPer, $rPat){
        try{
            $del= new \Modelo\Delegado($rPer['apellido'], $rPer['nombre'], $rPer['dni'], $rPer['fNacimiento'],
                    $rPer['sexo'], $rPer['nacionalidad'], $rPer['exportada'], $rPer['fechaAlta'], $rPat['email']);
            $del->setIdDelegado($rPat['idDelegado']);
            $del->setIdPersona($rPat['idPersona']);
            $del->setDomicilio($this->cDom->traerDomicilioXID($rPer['idDomicilio']));
            $del->setLicencia($this->cLic->traerLicenciaXIdPersona($del->getIdPersona()));
            return $del;
        }  catch (mysqli_sql_exception $ex){
            echo 'Error: ' . $ex->getMessage();
        }
    }
    
    public function listarDelegados($idClub){
        $delegado_array= array();
        try{
            if ($idClub!=0) {
                 $r1= static::$bd->getConexion()->query("SELECT * FROM persona WHERE idClub='$idClub");
                 while ($f=$r1->fetch_array()) {
                     $idP=$f['idPersona'];
                     $r2=  static::$bd->getConexion()->query("SELECT * FROM delegado WHERE idPersona='$idP");
                    if ($f2=$r2->fetch_array()) {
                        array_push($delegado_array, $this->armarPatinador($f, $f2));
                    }
                 }
            }else {
                $r1= static::$bd->getConexion()->query("SELECT * FROM persona");
                 while ($f=$r1->fetch_array()) {
                     $idP=$f['idPersona'];
                     $r2=  static::$bd->getConexion()->query("SELECT * FROM patinador WHERE idPersona='$idP");
                     while ($f2=$r2->fetch_array()) {
                        $f2=$r2->fetch_array();
                        array_push($delegado_array, $this->armarPatinador($f, $f2));
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
