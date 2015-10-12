<?php

require_once '..\..\..\Modelo\Usuario.php';
require_once '..\..\..\Controlador\ControladorClub';

class ControladorUsuario extends ControladorGeneral {
    private $cCl;
    function __construct() {
        $this->cCl= new ControladorClub();
    }
    
    public function traerUsuario($user, $pass){
        $u=null;
        try {
            $r= static::$bd->getConexion()->query("select * from usuario where user='$user' AND pass='$pass' AND estado=true");
            while($us=$r->fetch_array()){
                $u= new Modelo\Usuario($us['user'], $us['pass'], $us['tipo']);
                $u->setIdUsuario($us['idUsuario']);
                $u->setClub($this->cCl->traerClubXID($us['idClub']));
            }
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
        
        if ($u!=NULL) {
            return $u;
        }else{
            return NULL;
        }
    }
    
    public function agregarUsuario($user, $pass, $tipo, $idClub){
        try{
          if(!(static::$bd->getConexion()->query("insert into usuario values(null,'$user','$pass','$tipo','$idClub',true'"))){
              die(static::$bd->getConexion()->error);
          }
              
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function cambiarContraseña($idUser, $newPass){
        try{
            if (!(static::$bd->getConexion()->query("update usuario set(pass='$newPass') where idUsuario='$idUser"))) {
                die(static::$bd->getConexion()->error);
            }
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function deshabilitarUsuario($idUser){
        try{
            if (!(static::$bd->getConexion()->query("update usuario set(estado=false) where idUsuario='$idUser"))) {
                die(static::$bd->getConexion()->error);
            }
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    
    
}
