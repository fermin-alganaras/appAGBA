<?php

require_once '..\..\..\Modelo\Domicilio.php';

class ControladorDomicilio extends ControladorGeneral {
    //put your code here
    function __construct() {
        parent::__construct();
    }
    
    public function insertarDomicilio($direccion, $cp, $telefono, $localidad, $provincia){
        if (!static::$bd->getConexion()->query("insert into domicilio values(null,'$direccion','
                $cp','$telefono','$localidad',' $provincia')")){
            die ("Error en la query de Controlador Domicilio");
        }
    }
    
    public function traerUltimoId(){
        $r=static::$bd->getConexion()->query("SELECT MAX(idDomicilio) AS id FROM domicilio" )->fetch_array();
        echo 'ultimo id de domicilio'. $r['id'];
        return $r['id'];    
    }
    
    public function traerDomicilioXID($id){
        $r=  static::$bd->getConexion()->query("SELECT * FROM domicilio WHERE idDomicilio=". $id)->fetch_array();
        $d= new \Modelo\Domicilio($r['direccion'], $r['cp'], $r['telefono'], $r['localidad'], $r['provincia']);
        $d->setIdDomicilio($r['idDomicilio']);
        return $d;
    }
    
    public function actualizarDomicilio(Domicilio $dom){
        try{
            static::$bd->getConexion()->query("START TRANSACTION");
            static::$bd->getConexion()->query("UPDATE Domicilio direccion=".$dom->getDireccion()." cp=". $dom->getCp().
                " telefono=". $dom->getTelefono(). " localidad=". $dom->getLocalidad(). " provincia=".$dom->getProvincia().
                " WHERE idDomicilio=".$dom->getIdDomicilio());
            static::$bd->getConexion()->query("COMMIT");
        } catch(mysqli_sql_exception $ex){
            static::$bd->getConexion()->query("ROLLBACK");
            echo 'Error: '. $ex->getMessage();
        }
    }
}
