<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorBaseDeDatos
 *
 * @author JuanPAblo
 */
class ControladorBaseDeDatos {

    private $host= "localhost";
    private $user= "root";
    private $pass= "4984313";
    private $base= "appagba";
    private $con= null;

    function __construct() {

    }

    private function conectar(){
        $this->con= new mysqli($this->host, $this->user, $this->pass, $this->base, "3306");
    }

    public function getConexion(){
        if($this->con != null){
            return $this->con;
        } else {
            $this->conectar();
            //echo 'Se creo conexion';
            return $this->con;
        }
    }

    public function liberarResultados(){
        $this->con->free();
    }

    public function cerrarConexion(){
        $this->con->close();
    }
}
