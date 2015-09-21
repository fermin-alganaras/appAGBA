<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tecnico
 *
 * @author JuanPAblo
 */
class Tecnico extends Persona {
    
    private $idTecnico;
    private $categoria;
    
    
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
