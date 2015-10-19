<?php

require_once ('..\..\..\Modelo\Alta.php');
require_once ('ControladorPatinador.php');
require_once ('ControladorTecnico.php');
require_once ('ControladorDelegado.php');
require_once ('ControladorUsuario.php');
require_once ('ControladorLicencia.php');
require_once ('ControladorNotificacion.php');

 
class ControladorAlta {
    
    private $cPat;
    private $cUser;
    private $cNot;
    private $cDel;
    private $cLic;
    private $cTec;
    
    function __construct() {
        $this->cPat= ServidorControladores::getConPatinador();
        $this->cUser= ServidorControladores::getConUsuario();
        $this->cNot= ServidorControladores::getConNotificacion();
        $this->cTec= ServidorControladores::getConTecnico();
        $this->cDel= ServidorControladores::getConDelegado();
        $this->cLic= ServidorControladores::getConLicencia();
        
                
    }
    
    public function nuevaAlta($idsPat, $idsTec, $idsDel, $idUser){
        $fecha= date(DATE_W3C);
        try{
            ServidorControladores::getConBD()->getConexion()->query('START TRANSACTION');
            if(ServidorControladores::getConBD()->getConexion()->query("INSERT INTO alta VALUES(null,'$fecha','$idsPat','"
                    . "$idsTec','$idsDel','$idUser',false)")){
                $this->cNot->nuevaNotifAlta($this->traerUltimoId(), $idUser);
                ServidorControladores::getConBD()->getConexion()->query('COMMIT');
                return true;
            }else{
                ServidorControladores::getConBD()->getConexion()->query('ROLLBACK');
                echo ServidorControladores::getConBD()->getConexion()->error;
                return false;
            }
        }  catch (mysqli_sql_exception $ex){
            echo $ex->getMessage();
        }
    }
    
   
    
    public function aceptarAlta($idAlta){
        $a= $this->traerAltaXID($idAlta);
        if(count($a->getPatinadores())>0){
            foreach ($a->getPatinadores() as $pat) {
                $tipo=$this->cLic->defineLicencia($pat->getCatEsc(), $pat->getCatLibre(), $pat->getCatDanza());
                $b=$this->cPat->creaOHabilitaLicencia($pat, $tipo);
                if($b==false){
                    return false;
                }
                
            }
        }
        if(count($a->getTecnicos())>0){
            foreach ($a->getTecnicos() as $tec) {
                $b=$this->cTec->creaOHabilitaLicencia($tec->getIdTecnico(), $tec->getCat()->getTipoLicencia());
                if($b==false){
                        return false;
                }
            }
        }
        if(count($a->getDelegados())>0){
            foreach ($a->getDelegados() as $del) {
                $b=$this->cDel->creaOHabilitaLicencia($del->getIdDelegado(), 'Delegado');
                if($b==false){
                        return false;
                }                
            }
        }
        $this->altaAtendida($idAlta);
        $this->cNot->nuevaNotifAceptAlta($a);
        return true;
    }
    
    public function traerAltaXID($idAlta){
        $a= null;
        $patinadores=array();
        $tecnicos= array();
        $delegados= array();
        
        try {
            if(!$r= ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM alta WHERE idAlta='$idAlta'")){
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            while($f=$r->fetch_array()){
                $a= new Modelo\Alta($f['fecha'], $f['atendida']);
                $a->setIdAlta($f['idAlta']);
                $idp= explode('-', $f['idsPat']);
                $idt= explode('-', $f['idsTec']);
                $idd= explode('-', $f['idsDel']);
                if ((count($idp)>0) && ($idp[0]!=null)) {
                    foreach ($idp as $idPat) {
                        array_push($patinadores, $this->cPat->traerPatinadorXID($idPat));  
                    }
                }
                if ((count($idt)>0) && ($idt[0]!=null)){
                    foreach ($idt as $idTec) {
                        array_push($tecnicos, $this->cTec->traerTecnicoXID($idTec));
                    }
                }
                if((count($idd)>0) && ($idd[0]!=null)){
                    foreach ($idd as $idDel) {
                        array_push($delegados, $this->cDel->traerDelegadoXID($idDel));
                    }
                }
                $a->setPatinadores($patinadores);
                $a->setTecnicos($tecnicos);
                $a->setDelegados($delegados);
                $a->setUser($this->cUser->traerUsuarioXID($f['idUser']));
                
            }
            return $a;
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function traerUltimoId(){
        $r=ServidorControladores::getConBD()->getConexion()->query("SELECT MAX(idAlta) AS id FROM alta" )->fetch_array();
        return $r['id'];    
    }
    
    public function altaAtendida($idAlta){
       if(ServidorControladores::getConBD()->getConexion()->query("UPDATE alta SET atendida=true WHERE idAlta='$idAlta'")){
           return true;
       }else{
           die(ServidorControladores::getConBD()->getConexion()->error);
           return false;
       }
    }
    
    
    
    
}
