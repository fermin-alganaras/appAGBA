<?php
namespace Modelo;

include_once ('Persona.php');

class Patinador extends Persona {
    
    public $idPatinador;
    public $catEsc;
    public $catLibre;
    public $catDanza;
    public $ultimaComp;
    
    function __construct($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $idClub,$fechaAlta, $ultimaComp) {
        parent::__construct($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta, $idClub);
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
