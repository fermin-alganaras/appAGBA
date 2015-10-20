<?php

namespace Modelo;
class Categoria {
    public $idCategoria;
    public $denominacion;
    public $orden;
    public $modo;
    public $ascensos;
    public $tipoLicencia;
    
    function __construct($denominacion, $orden, $modo, $tipoLicencia) {
        $this->denominacion = $denominacion;
        $this->orden = $orden;
        $this->modo = $modo;
        $this->ascensos= array();
        $this->tipoLicencia= $tipoLicencia;
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





    
}
