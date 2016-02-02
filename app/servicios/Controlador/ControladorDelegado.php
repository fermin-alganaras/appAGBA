<?php

require_once ('..\..\..\Modelo\Delegado.php');
require_once ('ControladorGeneral.php');
require_once ('ControladorDomicilio.php');
require_once ('ControladorLicencia.php');
require_once ('ControladorCategoria.php');
require_once ('ControladorClub.php');

class ControladorDelegado {

    private $cDom;
    private $cLic;
    private $cCat;
    private $cClub;

    function __construct() {
        $this->cDom = ServidorControladores::getConDomicilio();
        $this->cLic = ServidorControladores::getConLicencia();
        $this->cCat = ServidorControladores::getConCategoria();
        $this->cClub = ServidorControladores::getConClub();
    }

    public function insertarDelegado($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta, $idClub, $direccion, $cp, $telefono, $localidad, $provincia, $email) {
        try {
            if (!ServidorControladores::getConBD()->getConexion()->query("START TRANSACTION")) {
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            $this->cDom->insertarDomicilio($direccion, $cp, $telefono, $localidad, $provincia);
            $idDomicilio = $this->cDom->traerUltimoID();
            if (!ServidorControladores::getConBD()->getConexion()->query("insert into persona values(null,'$apellido','$nombre','$dni','
                $fNacimiento','$sexo','$nacionalidad','$exportada','$fechaAlta','$idClub','$idDomicilio',null)")) {
                ServidorControladores::getConBD()->getConexion()->query("ROLLBACK");
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            $idP = ServidorControladores::getConBD()->getConexion()->query("SELECT MAX(idPersona) AS id FROM persona")->fetch_array();
            $idPer = $idP['id'];

            if (!ServidorControladores::getConBD()->getConexion()->query("insert into delegado values(null,'$email','$idPer')")) {
                ServidorControladores::getConBD()->getConexion()->query("ROLLBACK");
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            ServidorControladores::getConBD()->getConexion()->query("COMMIT");
            return $this->traerUltimoId();
        } catch (mysqli_sql_exception $ex) {
            ServidorControladores::getConBD()->getConexion()->query("ROLLBACK");
            echo 'Error: ' . $ex->getMessage();
            return FALSE;
        }
    }

    public function actualizarDelegado(Modelo\Delegado $del) {
        try {
            ServidorControladores::getConBD()->getConexion()->query("START TRANSACTION");
            $this->cDom->actualizarDomicilio($del->getDomicilio());
            if (!ServidorControladores::getConBD()->getConexion()->query("update persona set apellido='$del->apellido', nombre='$del->nombre',dni='$del->dni', fnacimiento='$del->fNacimiento' where idPersona='$del->idPersona'")) {
                ServidorControladores::getConBD()->getConexion()->query("ROLLBACK");
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            if (!ServidorControladores::getConBD()->getConexion()->query("update delegado set email='$del->email' where idPersona='$del->idPersona'")) {
                ServidorControladores::getConBD()->getConexion()->query("ROLLBACK");
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            ServidorControladores::getConBD()->getConexion()->query("COMMIT");
            return true;
        } catch (mysqli_sql_exception $ex) {
            ServidorControladores::getConBD()->getConexion()->query("ROLLBACK");
            echo 'Error: ' . $ex->getMessage();
            return FALSE;
        }
    }

    public function traerDelegadoXID($id) {
        try {
            $del= NULL;
            if (!$rDel = ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM delegado WHERE idDelegado='$id'")) {
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            while ($r = $rDel->fetch_array()) {
                $idP = $r['idPersona'];
                if (!$rPer = ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM persona WHERE idPersona='$idP'")) {
                    die(ServidorControladores::getConBD()->getConexion()->error);
                }
                while ($r2 = $rPer->fetch_array()) {
                    $del= $this->armarDelegado($r2, $r);
                }
            }
            return $del;

        } catch (mysqli_sql_exception $ex) {
            echo 'Error: ' . $ex->getMessage();
            return null;
        }
    }

    private function armarDelegado($rPer, $rPat) {
        try {
            $del = new \Modelo\Delegado($rPer['apellido'], $rPer['nombre'], $rPer['dni'], $rPer['fNacimiento'], $rPer['sexo'], $rPer['nacionalidad'], $rPer['exportada'], $rPer['fechaAlta'], $rPer['idClub'], $rPat['email']);
            $del->setIdDelegado($rPat['idDelegado']);
            $del->setIdPersona($rPer['idPersona']);
            $del->setDomicilio($this->cDom->traerDomicilioXID($rPer['idDomicilio']));
            if ($rPer['idLicencia'] != null) {
                $del->setLicencia($this->cLic->traerLicenciaXIdPersona($del->getIdPersona()));
            } else {
                $del->setLicencia(null);
            }
            $del->setFNacimiento(ServidorControladores::invertirFecha($del->getFNacimiento()));
            $del->setClub(ServidorControladores::getConClub()->traerClubXID($rPer['idClub']));
            return $del;
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: ' . $ex->getMessage();
        }
    }

    public function listarDelegados($idClub) {
        $delegado_array = array();
        try {
            if ($idClub != 0) {
                $r1 = ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM persona WHERE idClub='$idClub'");
                while ($f = $r1->fetch_array()) {
                    $idP = $f['idPersona'];
                    $r2 = ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM delegado WHERE idPersona='$idP'");
                    if ($f2 = $r2->fetch_array()) {
                        array_push($delegado_array, $this->armarDelegado($f, $f2));
                    }
                }
            } else {
                $r1 = ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM persona");
                while ($f = $r1->fetch_array()) {
                    $idP = $f['idPersona'];
                    $r2 = ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM delegado WHERE idPersona='$idP'");
                    while ($f2 = $r2->fetch_array()) {
                        array_push($delegado_array, $this->armarDelegado($f, $f2));
                    }
                }
            }
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: ' . $ex->getMessage();
        }
        return $delegado_array;
    }

    public function listarActivosXClub($idClub) {
        $delegado_array = $this->listarDelegados($idClub);
        foreach ($delegado_array as $p) {
            if (!($p->getLicencia()->getActiva())) {
                unset($p);
            }
        }

        return $delegado_array;
    }

    public function listarNoActivosXClub($idClub) {
        $delegado_array = $this->listarDelegados($idClub);
        foreach ($delgado_array as $p) {
            if ($p->getLicencia()->getActiva()) {
                unset($p);
            }
        }

        return $delegado_array;
    }

    public function traerUltimoId() {
        $r = ServidorControladores::getConBD()->getConexion()->query("SELECT MAX(idPatinador) AS id FROM patinador")->fetch_array();

        return $r['id'];
    }

    public function creaOHabilitaLicencia($del, $tipo) {

        if ($del->getLicencia() == null) {
            $this->cLic->nuevaLicencia($tipo);
            $idLic = $this->cLic->traerUltimoId();
            $idP = $del->getIdPersona();
            if(!ServidorControladores::getConBD()->getConexion()->query("UPDATE persona SET idLicencia='$idLic' WHERE idPersona='$idP'")){
                die(ServidorControladores::getConBD()->getConexion()->error. 'en delegado');
            }
            return true;
        } elseif ($del->getLicencia()->getActiva() == false) {
            $this->cLic->habilitaODeshabilita($del->getLicencia());
            return true;
        } else {
            return false;
        }
    }
    
    public function pendientesExportar(){
        $pendientes=array();
        try{
            if(!$r= ServidorControladores::getConBD()->getConexion()->query('SELECT * FROM persona WHERE exportada=1')){
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            while($f1=$r->fetch_array()){
                $idP=$f1['idPersona'];
                if(!$r2= ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM delegado WHERE idPersona='$idP'")){
                    die(ServidorControladores::getConBD()->getConexion()->error);
                }
                while($f2=$r2->fetch_array()){
                    $pat= $this->armarDelegado($f1, $f2);
                    array_push($pendientes, $pat);
                }
            }
        } catch (Exception $ex) {

        }
        return $pendientes;
    }
    
    public function activoDefinitivo($idPersona){
        try {
            if(!ServidorControladores::getConBD()->getConexion()->query("UPDATE persona SET exportada=2 WHERE idPersona='$idPersona'")){
                 die(ServidorControladores::getConBD()->getConexion()->error);
            }
        } catch (Exception $ex) {

        }
    }
    
    public function activoPendientes($idPersona){
        try {
            if(!ServidorControladores::getConBD()->getConexion()->query("UPDATE persona SET exportada=1 WHERE idPersona='$idPersona'")){
                 die(ServidorControladores::getConBD()->getConexion()->error);
            }
        } catch (Exception $ex) {

        }
    }
}
