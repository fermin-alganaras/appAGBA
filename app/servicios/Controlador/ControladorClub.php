<?php
require_once ('ControladorGeneral.php');
require_once ('ControladorDomicilio.php');
require_once '..\..\..\Modelo\Club.php';

class ControladorClub {

    private $cDom;
    function __construct() {
        $this->cDom= ServidorControladores::getConDomicilio();
    }

    public function agregarClub($nombre, $presidente, $secretario, $direccion,
            $cp, $telefono, $localidad, $provincia){
        try{
            $this->cDom->insertarDomicilio($direccion, $cp, $telefono, $localidad, $provincia);
            $idDomicilio= $this->cDom->traerUltimoID();
            if(!ServidorControladores::getConBD()->getConexion()->query("INSERT INTO club VALUES(default,'$nombre
                    ','$presidente','$secretario','$idDomicilio')")){
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            return $this->traerClubXID($this->traerUltimoId());
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
    }

    public function traerClubXID($id){
        try {
            $r= ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM club WHERE idClub='$id'")->fetch_array();
            $club= new Modelo\Club($r['nombre'], $r['presidente'], $r['secretario']);
            $club->setIdClub($r['idClub']);
            $club->setDomicilio($this->cDom->traerDomicilioXID($r['idDomicilio']));
            return $club;
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
        
    }
    
    public function listarClubes(){
        $clubes= array();
        try {
            $r=  ServidorControladores::getConBD()->getConexion()->query('SELECT * FROM club');
            while ($f=$r->fetch_array()){
                $c=new Modelo\Club($f['nombre'], $f['presidente'], $f['secretario']);
                $c->setIdClub($f['idClub']);
                $c->setDomicilio(ServidorControladores::getConDomicilio()->traerDomicilioXID($f['idDomicilio']));
                array_push($clubes, $c);
            }
            return $clubes;
        } catch (Exception $ex) {
            
        }
    }
    public function traerUltimoId(){
        $r=ServidorControladores::getConBD()->getConexion()->query("SELECT MAX(idClub) AS id FROM club" )->fetch_array();
        return $r['id'];    
    }
}
