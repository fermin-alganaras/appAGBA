<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Licencia
 *
 * @author JuanPAblo
 */
class Licencia {
    
    private $IdLicencia;
    private $nombre;
    private $costo;
    
    
    function __construct($nombre, $costo) {
        $this->nombre = $nombre;
        $this->costo = $costo;
    }
    
    function getIdLicencia() {
        return $this->IdLicencia;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getCosto() {
        return $this->costo;
    }

    function setIdLicencia($IdLicencia) {
        $this->IdLicencia = $IdLicencia;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCosto($costo) {
        $this->costo = $costo;
    }



}
