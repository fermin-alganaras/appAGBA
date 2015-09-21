<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Persona
 *
 * @author JuanPAblo
 */
abstract class Persona {
    
    protected $idPersona;
    protected $apellido;
    protected $nombre;
    protected $dni;
    protected $fNacimiento;
    protected $sexo;
    protected $nacionalidad;
    protected $exportada;
    protected $fechaAlta;
    protected $licencia;
    protected $club;
    
    function __construct($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta) {
        $this->apellido = $apellido;
        $this->nombre = $nombre;
        $this->dni = $dni;
        $this->fNacimiento = $fNacimiento;
        $this->sexo = $sexo;
        $this->nacionalidad = $nacionalidad;
        $this->exportada= $exportada;
        $this->fechaAlta= $fechaAlta;
    }
    
    function getIdPersona() {
        return $this->idPersona;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDni() {
        return $this->dni;
    }

    function getFNacimiento() {
        return $this->fNacimiento;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getNacionalidad() {
        return $this->nacionalidad;
    }

    function setIdPersona($idPersona) {
        $this->idPersona = $idPersona;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    function setFNacimiento($fNacimiento) {
        $this->fNacimiento = $fNacimiento;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setNacionalidad($nacionalidad) {
        $this->nacionalidad = $nacionalidad;
    }
    
    function getExportada() {
        return $this->exportada;
    }

    function getFechaAlta() {
        return $this->fechaAlta;
    }

    function getLicencia() {
        return $this->licencia;
    }

    function setExportada($exportada) {
        $this->exportada = $exportada;
    }

    function setFechaAlta($fechaAlta) {
        $this->fechaAlta = $fechaAlta;
    }

    function setLicencia($licencia) {
        $this->licencia = $licencia;
    }

    function getClub() {
        return $this->club;
    }

    function setClub($club) {
        $this->club = $club;
    }






}
