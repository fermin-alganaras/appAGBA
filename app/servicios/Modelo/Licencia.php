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
    private $numero;
    private $costo;
    private $tipo;
    
    
    function __construct($numero, $costo, $tipo) {
        $this->numero = $numero;
        $this->costo = $costo;
    }
    
    function getIdLicencia() {
        return $this->IdLicencia;
    }

    function getNumero() {
        return $this->numero;
    }

    function getCosto() {
        return $this->costo;
    }

    function setIdLicencia($IdLicencia) {
        $this->IdLicencia = $IdLicencia;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setCosto($costo) {
        $this->costo = $costo;
    }
    
    function getTipo() {
        return $this->tipo;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }





}
