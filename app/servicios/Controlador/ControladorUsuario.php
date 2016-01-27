<?php

require_once '..\..\..\Modelo\Usuario.php';
require_once 'ControladorClub.php';
require_once ('ControladorGeneral.php');

class ControladorUsuario {
    private $cCl;
    function __construct() {
        $this->cCl= ServidorControladores::getConClub();
    }

    public function traerUsuario($user, $pass){
        $u=null;
        try {
            $r= ServidorControladores::getConBD()->getConexion()->query("select * from usuario where user='$user' AND pass='$pass' AND estado=true");
            while($us=$r->fetch_array()){
                $u= new Modelo\Usuario($us['user'], $us['pass'], $us['tipo'], $us['estado'], $us['ultimaSesion']);
                $u->setIdUsuario($us['idUsuario']);
                $u->setClub($this->cCl->traerClubXID($us['idClub']));
            }
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
        return $u;
    }
    
    public function traerUsuarioXID($idUser){
         $u=null;
        try {
            $r= ServidorControladores::getConBD()->getConexion()->query("select * from usuario where idUsuario='$idUser'");
            while($us=$r->fetch_array()){
                $u= new Modelo\Usuario($us['user'], '', $us['tipo'], $us['estado'], $us['ultimaSesion']);
                $u->setIdUsuario($us['idUsuario']);
                $u->setClub($this->cCl->traerClubXID($us['idClub']));
            }
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
        return $u;
    }

    public function agregarUsuario($user, $pass, $tipo, $idClub){
        try{
          if(!(ServidorControladores::getConBD()->getConexion()->query("insert into usuario values(null,'$user','$pass','$tipo','$idClub',true, 0000-00-00)"))){
              die(ServidorControladores::getConBD()->getConexion()->error);
          }
          return $this->traerUsuarioXID($this->traerUltimoId());
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function cambiarContrasenia($idUser, $newPass){
        try{
            if (!(ServidorControladores::getConBD()->getConexion()->query("update usuario set pass='$newPass' where idUsuario='$idUser'"))) {
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            return TRUE;
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
            return FALSE;
        }
    }

    public function deshabilitarUsuario($idUser){
        try{
            if (!(ServidorControladores::getConBD()->getConexion()->query("update usuario set(estado=false) where idUsuario='$idUser'"))) {
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function listarUsuarios(){
        $usuarios= array();
        try {
         $r= ServidorControladores::getConBD()->getConexion()->query("select * from usuario where estado=true");
            while($us=$r->fetch_array()){
                $u= new Modelo\Usuario($us['user'], '', $us['tipo'], $us['estado'], $us['ultimaSesion']);
                $u->setIdUsuario($us['idUsuario']);
                $u->setClub($this->cCl->traerClubXID($us['idClub']));
                array_push($usuarios, $u);
            }
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
        return $usuarios;
    }
    
    public function traerUltimoId(){
        $r=ServidorControladores::getConBD()->getConexion()->query("SELECT MAX(idUsuario) AS id FROM usuario" )->fetch_array();
        
        return $r['id'];    
    }
    
    public function usuarioClub($idClub){
          $u=null;
        try {
            $r= ServidorControladores::getConBD()->getConexion()->query("select * from usuario where idClub='$idClub'");
            while($us=$r->fetch_array()){
                $u= new Modelo\Usuario($us['user'], '', $us['tipo'], $us['estado'], $us['ultimaSesion']);
                $u->setIdUsuario($us['idUsuario']);
                $u->setClub($this->cCl->traerClubXID($us['idClub']));
            }
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
        return $u;
    }



}
