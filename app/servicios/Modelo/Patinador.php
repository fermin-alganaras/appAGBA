<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Patinador
 *
 * @author JuanPAblo
 */
class Patinador extends Persona {
    
    private $idPatinador;
    private $catEsc;
    private $catLibre;
    private $catDanza;
    private $ultimaComp;
    
    function __construct($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta, $ultimaComp) {
        parent::__construct($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta);
        $this->ultimaComp = $ultimaComp;
    }
    
    function getIdPatinador() {
        return $this->idPatinador;
    }

    function getCatEsc() {
        return $this->catEsc;
    }

    function getCatLibre() {
        return $this->catLibre;
    }

    function getCatDanza() {
        return $this->catDanza;
    }

    function getUltimaComp() {
        return $this->ultimaComp;
    }

    function setIdPatinador($idPatinador) {
        $this->idPatinador = $idPatinador;
    }

    function setCatEsc($catEsc) {
        $this->catEsc = $catEsc;
    }

    function setCatLibre($catLibre) {
        $this->catLibre = $catLibre;
    }

    function setCatDanza($catDanza) {
        $this->catDanza = $catDanza;
    }

    function setUltimaComp($ultimaComp) {
        $this->ultimaComp = $ultimaComp;
    }



}
