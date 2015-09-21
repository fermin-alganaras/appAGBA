<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categoria
 *
 * @author JuanPAblo
 */
class Categoria {
    private $idCategoria;
    private $denominacion;
    private $orden;
    private $single;
    private $pareja;
    private $grupal;
    private $esc;
    private $libr;
    private $sd;
    private $fr;
    private $modo;
    private $ascensos;
    
    function __construct($denominacion, $orden, $single, $pareja, $grupal, $esc, $libr, $sd, $fr, $modo) {
        $this->denominacion = $denominacion;
        $this->orden = $orden;
        $this->single = $single;
        $this->pareja = $pareja;
        $this->grupal = $grupal;
        $this->esc = $esc;
        $this->libr = $libr;
        $this->sd = $sd;
        $this->fr = $fr;
        $this->modo = $modo;
        $this->ascensos= array();
    }
    
    function getIdCategoria() {
        return $this->idCategoria;
    }

    function getDenominacion() {
        return $this->denominacion;
    }

    function getOrden() {
        return $this->orden;
    }

    function getSingle() {
        return $this->single;
    }

    function getPareja() {
        return $this->pareja;
    }

    function getGrupal() {
        return $this->grupal;
    }

    function getEsc() {
        return $this->esc;
    }

    function getLibr() {
        return $this->libr;
    }

    function getSd() {
        return $this->sd;
    }

    function getFr() {
        return $this->fr;
    }

    function getModo() {
        return $this->modo;
    }

    function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    function setDenominacion($denominacion) {
        $this->denominacion = $denominacion;
    }

    function setOrden($orden) {
        $this->orden = $orden;
    }

    function setSingle($single) {
        $this->single = $single;
    }

    function setPareja($pareja) {
        $this->pareja = $pareja;
    }

    function setGrupal($grupal) {
        $this->grupal = $grupal;
    }

    function setEsc($esc) {
        $this->esc = $esc;
    }

    function setLibr($libr) {
        $this->libr = $libr;
    }

    function setSd($sd) {
        $this->sd = $sd;
    }

    function setFr($fr) {
        $this->fr = $fr;
    }

    function setModo($modo) {
        $this->modo = $modo;
    }

    function getAscensos() {
        return $this->ascensos;
    }

    function setAscensos($ascensos) {
        $this->ascensos = $ascensos;
    }



    
}
