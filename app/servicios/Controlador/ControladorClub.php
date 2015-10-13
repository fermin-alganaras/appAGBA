<?php
require_once ('ControladorGeneral.php');
require_once ('ControladorDomicilio.php');
require_once '..\..\..\Modelo\Club.php';

class ControladorClub extends ControladorGeneral{

    private $cDom;
    function __construct() {
        parent::__construct();
        $this->cDom= new ControladorDomicilio();
    }

    public function agregarClub($nombre, $presidente, $secretario, $idUsuario, $direccion,
            $cp, $telefono, $localidad, $provincia){
        try{
            $this->cDom->insertarDomicilio($direccion, $cp, $telefono, $localidad, $provincia);
            $idDomicilio= $this->cDom->traerUltimoID();
            static::$bd->getConexion()->query("INSERT INTO club VALUES(default,'$nombre
                    ','$presidente','$secretario','$idUsuario','$idDomicilio ')");
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
    }

    public function traerClubXID($id){
        try {
            $r= static::$bd->getConexion()->query("SELECT * FROM club WHERE idClub=".$id)->fetch_array();
            $club= new Modelo\Club($r['nombre'], $r['presidente'], $r['secretario']);
            $club->setIdClub($r['idClub']);
            $club->setDomicilio($this->cDom->traerDomicilioXID($r['idDomicilio']));
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
    }

}
