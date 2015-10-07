<?php

namespace Modelo;
class ListaBnaFe {
    public $idListaBnaFe;
    public $fechaCreacion;
    public $refArchivo;
    public $club;
    public $torneo;
    
    
    function __construct($fechaCreacion, $refArchivo) {
        $this->fechaCreacion = $fechaCreacion;
        $this->refArchivo = $refArchivo;
    }
    
    function getIdListaBnaFe() {
        return $this->idListaBnaFe;
    }

    function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    function getRefArchivo() {
        return $this->refArchivo;
    }

    function setIdListaBnaFe($idListaBnaFe) {
        $this->idListaBnaFe = $idListaBnaFe;
    }

    function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;
    }

    function setRefArchivo($refArchivo) {
        $this->refArchivo = $refArchivo;
    }

    function getClub() {
        return $this->club;
    }

    function setClub($club) {
        $this->club = $club;
    }
    
    function getTorneo() {
        return $this->torneo;
    }

    function setTorneo($torneo) {
        $this->torneo = $torneo;
    }





}
