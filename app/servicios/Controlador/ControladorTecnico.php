<?php

require_once ('..\..\..\Modelo\Tecnico.php');
require_once ('ControladorGeneral.php');
require_once ('ControladorDomicilio.php');
require_once ('ControladorLicencia.php');
require_once ('ControladorCategoria.php');
require_once ('ControladorClub.php');

class ControladorTecnico extends \Modelo\Persona{
    private $cDom;
    private $cLic;
    private $cCat;
    private $cClub;
    function __construct() {
        parent::__construct();
        $this->cDom= new ControladorDomicilio;
        $this->cLic= new ControladorLicencia;
        $this->cCat= new ControladorCategoria;
        $this->cClub= new ControladorClub;
    }
    
    public function insertarTecnico($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta,
            $idClub, $direccion, $cp, $telefono, $localidad, $provincia, $idCat){
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
            
            if(!static::$bd->getConexion()->query("insert into tecnico values(null,'$idCat ','$idPer)")){
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
    
    public function traerTecnicoXID(int $id){
        try{
            $rTec=  static::$bd->getConexion()->query("SELECT * FROM tecnico WHERE idTecnico='$id")->fetch_array();
            $idP=$rTec['idPersona'];
            $rPer=  static::$bd->getConexion()->query("SELECT * FROM persona WHERE idPersona='$idP" )->fetch_array();
            $tec= $this->armarTecnico($rPer, $rTec);
            return $tec;
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
            return null;
        }
    }
    
       
    private function armarTecnico ($rPer, $rPat){
        try{
            $tec= new \Modelo\Tecnico($rPer['apellido'], $rPer['nombre'], $rPer['dni'], $rPer['fNacimiento'],
                    $rPer['sexo'], $rPer['nacionalidad'], $rPer['exportada'], $rPer['fechaAlta']);
            $tec->setIdTecnico($rPat['idTecnico']);
            $tec->setIdPersona($rPat['idPersona']);
            $tec->setDomicilio($this->cDom->traerDomicilioXID($rPer['idDomicilio']));
            $tec->setLicencia($this->cLic->traerLicenciaXIdPersona($tec->getIdPersona()));
            $tec->setCategoria($this->cCat->traerCategoriaXID($rPat['idCategoria']));
            
            return $tec;
        }  catch (mysqli_sql_exception $ex){
            echo 'Error: ' . $ex->getMessage();
        }
    }
    
    public function listarTodosXClub($idClub){
        $tecnicos_array= array();
        try{
            if ($idClub!=0) {
                 $r1= static::$bd->getConexion()->query("SELECT * FROM persona WHERE idClub='$idClub");
                 while ($f=$r1->fetch_array()) {
                     $idP=$f['idPersona'];
                    $r2=  static::$bd->getConexion()->query("SELECT * FROM tecnico WHERE idPersona='$idP" );
                    if ($f2=$r2->fetch_array()) {
                        array_push($tecnicos_array, $this->armarTecnico($f, $f2));
                    }
                 }
            }else {
                $r1= static::$bd->getConexion()->query("SELECT * FROM persona");
                 while ($f=$r1->fetch_array()) {
                     $idP=$f['idPersona'];
                     $r2=  static::$bd->getConexion()->query("SELECT * FROM tecnico WHERE idPersona='$idP");
                     while ($f2=$r2->fetch_array()) {
                        array_push($tecnicos_array, $this->armarPatinador($f, $f2));
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
    }//put your code here
}
