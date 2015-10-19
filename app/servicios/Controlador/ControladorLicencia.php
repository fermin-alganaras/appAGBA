<?php

require_once '..\..\..\Modelo\Licencia.php';
class ControladorLicencia {
    
    function __construct() {
       
    }
    
    public function traerLicenciaXIdPersona($id){
        try {
            $rLic= ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM licencia WHERE idLicencia='$id'");
            while($rL=$rLic->fetch_array()){
                $lic= new Modelo\Licencia($rL['numero'], $rL['tipo'], $rL['activa']);
                $lic->setIdLicencia($rL['idLicencia']);
                return $lic;
            }            
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
    }
    
    public function nuevaLicencia ($tipo, $activa){
        try{
            if(!ServidorControladores::getConBD()->getConexion()->query("INSERT INTO licencia VALUES(null, 'E/T','$tipo','$activa')")){
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
                ServidorControladores::getConBD()->getConexion->query("UPDATE licencia SET (activa=true) WHERE idLicencia='$id" );
            }else {
                ServidorControladores::getConBD()->getConexion->query("UPDATE licencia SET (activa=false) WHERE idLicencia='$id");
            }
            
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
    }
    
    public function defineLicencia($catEsc, $catLibr, $catDza){
        if (($catEsc->getOrden()>=$catLibr->getOrden()||($catLibr==null))
                &&(($catEsc->getOrden()>=$catDza->getOrden())||($catDza==null))) {
            return $catEsc->getTipoLicencia();
        }elseif (($catEsc->getOrden()<=$catLibr->getOrden()||($catEsc==null))
                &&(($catLibr->getOrden()>=$catDza->getOrden())||($catDza==null))) {
            return $catLibr->getTipoLicencia();
        }else{
            return $catDza->getTipoLicencia();
        }
    }

}
