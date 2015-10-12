<?php

namespace Modelo;
class Ascenso {
    public $idAscenso;
    public $totalPat;
    public $maxRango;
    public $repitencia;
    
    
    
    function __construct($totalPat, $maxRango, $repitencia) {
        $this->totalPat = $totalPat;
        $this->maxRango = $maxRango;
        $this->repitencia = $repitencia;
    }
    
    function getIdAscenso() {
        return $this->idAscenso;
    }

    function getTotalPat() {
        return $this->totalPat;
    }

    function getMaxRango() {
        return $this->maxRango;
    }

    function getRepitencia() {
        return $this->repitencia;
    }

    function setIdAscenso($idAscenso) {
        $this->idAscenso = $idAscenso;
    }

    function setTotalPat($totalPat) {
        $this->totalPat = $totalPat;
    }

    function setMaxRango($maxRango) {
        $this->maxRango = $maxRango;
    }

    function setRepitencia($repitencia) {
        $this->repitencia = $repitencia;
    }



}
