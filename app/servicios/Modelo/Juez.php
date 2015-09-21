<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Juez
 *
 * @author JuanPAblo
 */
class Juez extends Persona{
    
    private $idJuez;
    private $categoria;
    
    function __construct($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad,$exportada, $fechaAlta) {
        parent::__construct($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta);
        
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
