<?php

require_once '..\..\..\Modelo\Licencia.php';
class ControladorLicencia {
    
    function __construct() {
       
    }
    
    public function traerLicenciaXIdPersona($id){
        $lic= null;
        $idLic=null;
        try {
            if(!$rPer= ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM persona WHERE idPersona='$id'")){
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            while ($idLi=$rPer->fetch_array()) {
                $idLic=$idLi['idLicencia'];
            }
            if(!$rLic= ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM licencia WHERE idLicencia='$idLic'")){
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            while($rL=$rLic->fetch_array()){
                $lic= new Modelo\Licencia($rL['numero'], $rL['tipo'], $rL['activa']);
                $lic->setIdLicencia($rL['idLicencia']);
                return $lic;
            }            
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
            
        }
        return $lic;
    }
    
    public function nuevaLicencia ($tipo){
        try{
            if(!ServidorControladores::getConBD()->getConexion()->query("INSERT INTO licencia VALUES(null, 'E/T','$tipo','true')")){
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
        } catch(mysqli_sql_exception $ex){
            echo 'Error: '. $ex->getMessage();
        }
    }
    
    public function traerUltimoId(){
        $r=ServidorControladores::getConBD()->getConexion()->query("SELECT MAX(idLicencia) AS id FROM licencia" )->fetch_array();
        return $r['id'];    
    }
    
    public function habilitaODeshabilita(Licencia $lic){
        try {
            if (!$lic->getActiva()==true) {
                $id= $lic->getIdLicencia();
                if(!ServidorControladores::getConBD()->getConexion()->query("UPDATE licencia SET activa='true' WHERE idLicencia='$id'" )){
                    die(ServidorControladores::getConBD()->getConexion()->error);
                }
            }else {
                if(!ServidorControladores::getConBD()->getConexion()->query("UPDATE licencia SET activa='false' WHERE idLicencia='$id'")){
                    die(ServidorControladores::getConBD()->getConexion()->error);
                }
            }
            
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
    }
    
    public function defineLicencia($catEsc, $catLibr, $catSD, $catFD){
        if (($catEsc->getOrden()>=$catLibr->getOrden()||($catLibr==null))
                &&(($catEsc->getOrden()>=$catSD->getOrden())||($catSD==null))
                &&(($catEsc->getOrden()>=$catFD->getOrden())||($catFD==null))) {
            return $catEsc->getTipoLicencia();
        }elseif (($catEsc->getOrden()<=$catLibr->getOrden()||($catEsc==null))
                &&(($catLibr->getOrden()>=$catSD->getOrden())||($catSD==null))&& 
                (($catLibr->getOrden()>=$catFD->getOrden())||($catFD==null))) {
            return $catLibr->getTipoLicencia();
        }elseif (($catEsc->getOrden()<=$catSD->getOrden()||($catEsc==null))
                &&(($catLibr->getOrden()<=$catSD->getOrden())||($catLibr==null))&& 
                (($catSD->getOrden()>=$catFD->getOrden())||($catFD==null))) {
                return $catSD->getTipoLicencia();
        }else{
            return $catFD->getTipoLicencia();
        }
    }

}
