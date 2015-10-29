<?php

require_once '..\..\..\Modelo\Ascenso.php';

class ControladorAscenso {
    
    function __construct() {
        
    }
    
    public function insertarAscenso($totalPat, $maxRango, $repitencia){
        try{
            if (!ServidorControladores::getConBD()->getConexion()->query("INSERT INTO ascenso VALUES(null,'$totalPat','$maxRango'"
                    . ",'$repitencia')")) {
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            return TRUE;
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
        
    }
    
    public function traerAscensoXID($idAscenso){
        try{
            $a=null;
            if ($r=ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM ascenso WHERE idAscenso='$idAscenso'")) {
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            
            while ($f=$r->fetch_array()) {
                $a= new Modelo\Ascenso($f['totalPat'], $f['maxRango'], $f['repitencia']);
                $a->setIdAscenso($f['idAscenso']);
            }
            return $a;
        } catch (mysqli_sql_exception $ex) {
            die($ex->getMessage());
        }
        
    }
    
    
    public function traerArrayDeAscensoXIDCat($idCat){
        $array_ascensos= array();
        try{
            if ($r=ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM cat-asc WHERE idCat='$idCat'")) {
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            while ($f= $r->fetch_array()){
                array_push($array_ascensos, $this->traerAscensoXID($f['idAsc']));
            }
            return $array_ascensos;
        } catch (mysqli_sql_exception $ex) {
            die($ex->getMessage());
        }
    }

}
