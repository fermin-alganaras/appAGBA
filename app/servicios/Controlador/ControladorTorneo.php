<?php

require_once '..\..\..\Modelo\Torneo.php';

class ControladorTorneo {
    
    private $conListas;
    private $conComp;
    
    function __construct() {
        $this->conListas= ServidorControladores::getConListaBnaFe();
        $this->conComp= ServidorControladores::getConCompetencias();
    }

    
    public function nuevoTorneo($denominacion, $inicio, $fin){
        try{
            if (!ServidorControladores::getConBD()->getConexion()->query("INSERT INTO torneo VALUES(null,'$denominacion','$inicio','$fin',null)")) {
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            
            return TRUE;
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        } 
    }
    
    public function listarTodosXAnio($anio){
        $arrayTorneos= array();
        try{
            if (!$r=ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM torneo WHERE YEAR(fInicio)='$anio'")) {
                die(ServidorControladores::getConBD()->getConexion()->error());
            }
            
            while ($f=$r->fetch_array()) {
                $torneo= new Modelo\Torneo($f['denominacion'], $f['fInicio'], $f['fFin']);
                $torneo->setIdTorneo($f['idTorneo']);
                $torneo->setRefArchivo($f['refArchivo']);
                array_push($arrayTorneos, $torneo);
            }
            return $arrayTorneos;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
        return $arrayTorneos;
    }
    
    public function traerTorneoXID($idTorneo){
        $torneo= null;
         try{
            if (!$r=ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM torneo WHERE idTorneo='$idTorneo'")) {
                die(ServidorControladores::getConBD()->getConexion()->error());
            }
            
            while ($f=$r->fetch_array()) {
                $torneo= new Modelo\Torneo($f['denominacion'], $f['fInicio'], $f['fFin']);
                $torneo->setIdTorneo($f['idTorneo']);
                $torneo->setRefArchivo($f['refArchivo']);
            }
            return $torneo;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    
    public function cargarListasDeTorneo(Modelo\Torneo $torneo){
        $torneo->setListasBnaFe($this->conListas->traerListasXTorneo($torneo->getIdTorneo()));
    }
    
    public function cargarCompetencias(Modelo\Torneo $torneo){
        $torneo->setCompetencias($this->conComp->getCompetencias($torneo->idTorneo()));
    }
    
    public function guardarDataTorneo(Modelo\Torneo $torneo){
        if (file_exists("..\..\..\'$torneo->denominacion'.json")) {
            fopen("..\..\'$torneo->denominacion'.json", 'w');
            $dataJson= json_encode($torneo->getCompetencias());
            file_put_contents("..\..\'$torneo->denominacion'.json", $dataJson);
            fclose("..\..\'$torneo->denominacion'.json");
        }else{
            unlink("..\..\'$torneo->denominacion'.json");
            fopen("..\..\'$torneo->denominacion'.json", 'w');
            $dataJson= json_encode($torneo->getCompetencias());
            file_put_contents("..\..\'$torneo->denominacion'.json", $dataJson);
            fclose("..\..\'$torneo->denominacion'.json");
        }
    } 
    
    
}
