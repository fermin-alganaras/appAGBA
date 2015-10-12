<?php

namespace Modelo;
class Domicilio {
    public $idDomicilio;
    public $direccion;
    public $cp;
    public $telefono;
    public $localidad;
    public $provincia;
    
    function __construct($direccion, $cp, $telefono, $localidad, $provincia) {
        $this->direccion = $direccion;
        $this->cp = $cp;
        $this->telefono = $telefono;
        $this->localidad = $localidad;
        $this->provincia = $provincia;
    }
    
    function getIdDomicilio() {
        return $this->idDomicilio;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCp() {
        return $this->cp;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getLocalidad() {
        return $this->localidad;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function setIdDomicilio($idDomicilio) {
        $this->idDomicilio = $idDomicilio;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setCp($cp) {
        $this->cp = $cp;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    function setProvincia($provincia) {
        $this->provincia = $provincia;
    }



}
