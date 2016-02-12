<?php

require_once '..\..\..\Modelo\Torneo.php';

class ControladorTorneo {

    private $conListas;
    private $conComp;

    function __construct() {
        $this->conListas = ServidorControladores::getConListaBnaFe();
        $this->conComp = ServidorControladores::getConCompetencias();
    }

    public function nuevoTorneo($denominacion, $inicio, $fin, $organiza, $marca, $estado, $anio) {
        try {
            if (!ServidorControladores::getConBD()->getConexion()->query("INSERT INTO torneo VALUES(null,'$denominacion','$inicio','$fin',null,'$organiza','$marca','$estado','$anio')")) {
                die(ServidorControladores::getConBD()->getConexion()->error);
            }

            return TRUE;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    
    public function actualizarTorneo($idTorneo, $denominacion, $inicio, $fin, $organiza, $marca, $anio){
        try {
            if (!ServidorControladores::getConBD()->getConexion()->query("UPDATE torneo SET denominacion='$denominacion', fInicio='$inicio', fFin='$fin', organiza='$organiza', marca='$marca', anio='$anio' WHERE idTorneo='$idTorneo'")) {
                die(ServidorControladores::getConBD()->getConexion()->error);
            }

            return TRUE;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function listarTodosXAnio() {
        $arrayTorneos = array();
        try {
            $grupo = array('anio' => '', 'torneos' => array());
            if (!$r = ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM torneo ORDER BY anio DESC")) {
                die(ServidorControladores::getConBD()->getConexion()->error());
            }
            $fila = 0;
            while ($f = $r->fetch_array()) {
                $torneo = new Modelo\Torneo($f['denominacion'], $f['fInicio'], $f['fFin'], $f['organiza'], $f['marca'], $f['estado'], $f['anio']);
                $torneo->setIdTorneo($f['idTorneo']);
                $torneo->setRefArchivo($f['refArchivo']);
                if ($grupo['anio'] == $torneo->getAnio()) {
                    array_push($grupo['torneos'], $torneo);
                    $fila = $fila + 1;
                    if ($fila == ($r->num_rows)) {
                        array_push($arrayTorneos, $grupo);
                    }
                } elseif ($grupo['anio'] != '') {
                    array_push($arrayTorneos, $grupo);
                    $grupo['anio'] = $torneo->getAnio();
                    $grupo['torneos'] = array();
                    array_push($grupo['torneos'], $torneo);
                    $fila = $fila + 1;
                    if ($fila == ($r->num_rows)) {
                        array_push($arrayTorneos, $grupo);
                    }
                } else {
                    $grupo['anio'] = $torneo->getAnio();
                    array_push($grupo['torneos'], $torneo);
                    $fila = $fila + 1;
                    if ($fila == ($r->num_rows)) {
                        array_push($arrayTorneos, $grupo);
                    }
                }
            }
            return $arrayTorneos;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
        return $arrayTorneos;
    }

    public function traerTorneoXID($idTorneo) {
        $torneo = null;
        try {
            if (!$r = ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM torneo WHERE idTorneo='$idTorneo'")) {
                die(ServidorControladores::getConBD()->getConexion()->error());
            }

            while ($f = $r->fetch_array()) {
                $torneo = new Modelo\Torneo($f['denominacion'], $f['fInicio'], $f['fFin'], $f['organiza'], $f['marca'], $f['estado'], $f['anio']);
                $torneo->setIdTorneo($f['idTorneo']);
                $torneo->setRefArchivo($f['refArchivo']);
                $torneo->setListasBnaFe($this->cargarListasDeTorneo($torneo->getIdTorneo()));
                $torneo->setFInicio(ServidorControladores::invertirFecha($torneo->getFInicio()));
                $torneo->setFFin(ServidorControladores::invertirFecha($torneo->getFFin()));
                if ($torneo->getRefArchivo() != null) {
                    $torneo->setCompetencias($this->cargarCompetencias($torneo->getIdTorneo()));
                }
            }
            return $torneo;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function cargarListasDeTorneo($id) {
        return $this->conListas->traerListasXTorneo($id);
    }

    public function cargarCompetencias($id) {
        return $this->conComp->getCompetencias($id);
    }

    public function guardarDataTorneo(Modelo\Torneo $torneo) {
        if (file_exists("..\..\..\'$torneo->denominacion'.json")) {
            fopen("..\..\'$torneo->denominacion'.json", 'w');
            $dataJson = json_encode($torneo->getCompetencias());
            file_put_contents("..\..\'$torneo->denominacion'.json", $dataJson);
            fclose("..\..\'$torneo->denominacion'.json");
        } else {
            unlink("..\..\'$torneo->denominacion'.json");
            fopen("..\..\'$torneo->denominacion'.json", 'w');
            $dataJson = json_encode($torneo->getCompetencias());
            file_put_contents("..\..\'$torneo->denominacion'.json", $dataJson);
            fclose("..\..\'$torneo->denominacion'.json");
        }
    }
    
    public function abrirInscripcion($idTorneo){
        if (!ServidorControladores::getConBD()->getConexion()->query("UPDATE torneo SET estado=1 WHERE idTorneo='$idTorneo'")) {
            die(ServidorControladores::getConBD()->getConexion()->error);
        }
        
        ServidorControladores::getConNotificacion()->nuevaNotifAperTor($idTorneo);
        return 1;
    }
    
     public function cerrarInscripcion($idTorneo){
        if (!ServidorControladores::getConBD()->getConexion()->query("UPDATE torneo SET estado=2 WHERE idTorneo='$idTorneo'")) {
            die(ServidorControladores::getConBD()->getConexion()->error);
        }
        $this->procesarListas($idTorneo);
        ServidorControladores::getConNotificacion()->nuevaNotifCerrTor($idTorneo);
        return 1;
    }
    public function procesarListas($idTorneo){
        $torneo=$this->traerTorneoXID($idTorneo);
        foreach ($torneo->getListasBnaFe() as $lista) {
            foreach ($lista->getInfoLista() as $item) {
                $torneo->setCompetencias(ServidorControladores::getConCompetencias()->agregarCompetidorACompetencia($torneo->getCompetencias(), $item));
            }
        }
        print_r($torneo->getCompetencias());
        $this->guardarDataTorneo($torneo);
    }
}
