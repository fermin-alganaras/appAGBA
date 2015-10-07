<?php

namespace Modelo;
class Competencia {
    
    public $idCompetencia;
    public $denominacion;
    public $edad;
    public $archivo;
    public $torneo;
    
    function __construct($denominacion, $edad, $archivo) {
        $this->denominacion = $denominacion;
        $this->edad= $edad;
        $this->archivo= $archivo;
    }
    
    function getDenominacion() {
        return $this->denominacion;
    }

    function setDenominacion($denominacion) {
        $this->denominacion = $denominacion;
    }
    
    function getIdCompetencia() {
        return $this->idCompetencia;
    }

    function getEdad() {
        return $this->edad;
    }

    function getArchivo() {
        return $this->archivo;
    }

    function setIdCompetencia($idCompetencia) {
        $this->idCompetencia = $idCompetencia;
    }

    function setEdad($edad) {
        $this->edad = $edad;
    }

    function setArchivo($archivo) {
        $this->archivo = $archivo;
    }
    
    function getTorneo() {
        return $this->torneo;
    }

    function setTorneo($torneo) {
        $this->torneo = $torneo;
    }






}
