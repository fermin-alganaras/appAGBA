<?php
namespace Modelo;

include_once ('Persona.php');

class Patinador extends Persona {
    
    public $idPatinador;
    public $catEsc;
    public $catLibre;
    public $catSoloDance;
    public $catFreeDance;
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

    function getCatSoloDance() {
        return $this->catSoloDance;
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

    function setCatSoloDance($catSoloDance) {
        $this->catSoloDance = $catSoloDance;
    }

    function setUltimaComp($ultimaComp) {
        $this->ultimaComp = $ultimaComp;
    }
    
    function getCatFreeDance() {
        return $this->catFreeDance;
    }

    function setCatFreeDance($catFreeDance) {
        $this->catFreeDance = $catFreeDance;
    }


    



}
