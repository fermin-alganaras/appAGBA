<?php

namespace Modelo;
class Licencia {
    
    public $IdLicencia;
    public $numero;
   
    public $tipo;
    public $activa;
    
    
    function __construct($numero, $tipo, $activa) {
        $this->numero = $numero;
        $this->tipo= $tipo;
        $this->activa= $activa;
    }
    
    function getIdLicencia() {
        return $this->IdLicencia;
    }

    function getNumero() {
        return $this->numero;
    }

    

    function setIdLicencia($IdLicencia) {
        $this->IdLicencia = $IdLicencia;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    
    
    function getTipo() {
        return $this->tipo;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    
    function getActiva() {
        return $this->activa;
    }

    function setActiva($activa) {
        $this->activa = $activa;
    }







}
