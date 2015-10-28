<?php

namespace Modelo;
class Categoria {
    public $idCategoria;
    public $denominacion;
    public $orden;
    public $modo;
    public $ascensos;
    public $tipoLicencia;
    public $escuela;
    public $libre;
    public $soloDance;
    public $freeDance;
    public $showPresicion;
    public $solista;
    public $pareja;
    public $grupal;
    public $tipoPersona;
    
    function __construct($denominacion, $orden, $modo, $tipoLicencia, $escuela, $libre,
            $soloDance, $freeDance, $showPresicion, $solista, $pareja, $grupal, $tipoPersona) {
        $this->denominacion = $denominacion;
        $this->orden = $orden;
        $this->modo = $modo;
        $this->ascensos= array();
        $this->tipoLicencia= $tipoLicencia;
        $this->escuela= $escuela;
        $this->libre= $libre;
        $this->soloDance= $soloDance;
        $this->freeDance= $freeDance;
        $this->showPresicion= $showPresicion;
        $this->solista= $solista;
        $this->pareja= $pareja;
        $this->grupal= $grupal;
        $this->tipoPersona=$tipoPersona;
    }
    
    function getIdCategoria() {
        return $this->idCategoria;
    }

    function getDenominacion() {
        return $this->denominacion;
    }

    function getOrden() {
        return $this->orden;
    }

    function getModo() {
        return $this->modo;
    }

    function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    function setDenominacion($denominacion) {
        $this->denominacion = $denominacion;
    }

    function setOrden($orden) {
        $this->orden = $orden;
    }

    function setModo($modo) {
        $this->modo = $modo;
    }

    function getAscensos() {
        return $this->ascensos;
    }

    function setAscensos($ascensos) {
        $this->ascensos = $ascensos;
    }
    
    function getTipoLicencia() {
        return $this->tipoLicencia;
    }

    function setTipoLicencia($tipoLicencia) {
        $this->tipoLicencia = $tipoLicencia;
    }
    
    function getEscuela() {
        return $this->escuela;
    }

    function getLibre() {
        return $this->libre;
    }

    function getSoloDance() {
        return $this->soloDance;
    }

    function getFreeDance() {
        return $this->freeDance;
    }

    function getShowPresicion() {
        return $this->showPresicion;
    }

    function getSolista() {
        return $this->solista;
    }

    function getPareja() {
        return $this->pareja;
    }

    function getGrupal() {
        return $this->grupal;
    }

    function getTipoPersona() {
        return $this->tipoPersona;
    }

    function setEscuela($escuela) {
        $this->escuela = $escuela;
    }

    function setLibre($libre) {
        $this->libre = $libre;
    }

    function setSoloDance($soloDance) {
        $this->soloDance = $soloDance;
    }

    function setFreeDance($freeDance) {
        $this->freeDance = $freeDance;
    }

    function setShowPresicion($showPresicion) {
        $this->showPresicion = $showPresicion;
    }

    function setSolista($solista) {
        $this->solista = $solista;
    }

    function setPareja($pareja) {
        $this->pareja = $pareja;
    }

    function setGrupal($grupal) {
        $this->grupal = $grupal;
    }

    function setTipoPersona($tipoPersona) {
        $this->tipoPersona = $tipoPersona;
    }






    
}
