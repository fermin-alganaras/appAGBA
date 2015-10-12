<?php

require_once ('ControladorBaseDeDatos.php');

abstract class ControladorGeneral {
    
    static protected $bd;
    
    function __construct() {
        static::$bd= new ControladorBaseDeDatos();
    }
    
    

}
