<?php

namespace Modelo;
class Juez extends Persona{
    
    public $idJuez;
    public $categoria;
    
    function __construct($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad,$exportada, $fechaAlta, $idClub) {
        parent::__construct($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta, $idClub);
        
    }
    
    function getIdJuez() {
        return $this->idJuez;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function setIdJuez($idJuez) {
        $this->idJuez = $idJuez;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }



    
}
