<?php


require_once ('..\..\..\Modelo\Patinador.php');
require_once ('ControladorGeneral.php');
require_once ('ControladorDomicilio.php');
require_once ('ControladorLicencia.php');
require_once ('ControladorCategoria.php');
require_once ('ControladorClub.php');

class ControladorPatinador {
    
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
    
    public function insertarPatinador($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta,
            $idClub, $direccion, $cp, $telefono, $localidad, $provincia, $idCatEsc, $idCatLibr, $idCatDza){
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
            
            if(!ServidorControladores::getConBD()->getConexion()->query("insert into patinador values(null, null,'$idCatEsc','$idCatLibr','
                    $idCatDza','$idPer')")){
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
    
    public function traerPatinadorXID($id){
        try{
            $rPat=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM patinador WHERE idPatinador='$id'")->fetch_array();
            $idP=$rPat['idPer'];
            $rPer=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM persona WHERE idPersona='$idP'")->fetch_array();
            
            $pat= $this->armarPatinador($rPer, $rPat);
            return $pat;
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
            return null;
        }
    }
    
    public function traerUnPatinadorXAtributo(String $atributo, $valorAtributo){
        try{
            $rPer=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM persona WHERE '$atributo'='$valorAtributo")->fetch_array();
            $idP=$rPer['idPersona'];
            $rPat=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM patinador WHERE idPersona='$idP")->fetch_array();
            return $this->armarPatinador($rPer, $rPat);
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
    }
    
    private function armarPatinador ($rPer, $rPat){
        try{
            $pat= new \Modelo\Patinador($rPer['apellido'], $rPer['nombre'], $rPer['dni'], $rPer['fNacimiento'],
                    $rPer['sexo'], $rPer['nacionalidad'], $rPer['exportada'], $rPer['fechaAlta'], $rPat['ultimaComp']);
            $pat->setIdPatinador($rPat['idPatinador']);
            $pat->setIdPersona($rPat['idPer']);
            $pat->setDomicilio($this->cDom->traerDomicilioXID($rPer['idDomicilio']));
            $pat->setLicencia($this->cLic->traerLicenciaXIdPersona($pat->getIdPersona()));
            $pat->setCatEsc($this->cCat->traerCategoriaXID($rPat['idCatEsc']));
            $pat->setCatLibre($this->cCat->traerCategoriaXID($rPat['idCatLibre']));
            $pat->setCatDanza($this->cCat->traerCategoriaXID($rPat['idCatDanza']));
            $pat->setClub($this->cClub->traerClubXID($rPer['idClub']));
            return $pat;
        }  catch (mysqli_sql_exception $ex){
            echo 'Error: ' . $ex->getMessage();
        }
    }
    
    public function listarTodosXClub($idClub){
        $datos_persona= array();
        $patinadores_array= array();
        try{
            if ($idClub!=0) {
                 $r1= ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM persona WHERE idClub='$idClub'");
                 
                 while ($f=$r1->fetch_array()) {
                    $idP=$f['idPersona'];
                    $r2=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM patinador WHERE idPer='$idP'");
                    if ($f2=$r2->fetch_array()) {
                        array_push($patinadores_array, $this->armarPatinador($f, $f2));
                    }
                 }
            }else {
                $r1= ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM persona");
                while ($f=$r1->fetch_array()) {
                     array_push($datos_persona, $f);                
                }    
                $r1->free();
                foreach ($datos_persona as $fila) {
                    $idP=$fila['idPersona'];
                    $r2= ServidorControladores::getConBD()->getConexion()->query("select * from patinador where idPer=".$idP);
                    while ($f2= $r2->fetch_array()) {
                       array_push($patinadores_array, $this->armarPatinador($fila, $f2));
                    }
                }
            }
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
        return $patinadores_array;
    }
    
    public function listarActivosXClub($idClub){
        $patinadores_array= $this->listarTodosXClub($idClub);
        foreach ($patinadores_array as $p){
            if (!($p->getLicencia()->getActiva())) {
                unset($p);
            }
        }
        
        return $patinadores_array;
    }
    
     public function listarNoActivosXClub($idClub){
        $patinadores_array= $this->listarTodosXClub($idClub);
        foreach ($patinadores_array as $p){
            if ($p->getLicencia()->getActiva()) {
                unset($p);
            }
        }
        
        return $patinadores_array;
    }
    
    public function creaOHabilitaLicencia ($pat, $tipo){
        if ($pat->getLicencia()== null) {
            $this->cLic->nuevaLicencia($tipo, 'true');
            $idLic= $this->cLic->traerUltimoId();
            $idP= $pat->getIdPersona();
            if(!ServidorControladores::getConBD()->getConexion()->query("UPDATE persona SET idLicencia='$idLic' WHERE idPersona='$idP'")){
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            return true;
        }elseif($pat->getLicencia()->getActiva()==false){
            $this->cLic->habilitaODeshabilita($pat->getLicencia());
            return true;
        }else{
            return false;
        }
    }
    
    
    
    
    
    
    

}
