<?php

namespace Modelo;
class Tecnico extends Persona {
    
    public $idTecnico;
    public $categoria;
    
    
    function __construct($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta) {
        parent::__construct($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta);
    }
    
    function getIdTecnico() {
        return $this->idTecnico;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function setIdTecnico($idTecnico) {
        $this->idTecnico = $idTecnico;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
    
    


}
