<?php

require_once ('..\..\..\Modelo\Alta.php');

class ControladorAlta {

    private $cPat;
    private $cUser;
    private $cNot;
    private $cDel;
    private $cLic;
    private $cTec;

    function __construct() {
        $this->cPat = ServidorControladores::getConPatinador();
        $this->cUser = ServidorControladores::getConUsuario();
        $this->cNot = ServidorControladores::getConNotificacion();
        $this->cTec = ServidorControladores::getConTecnico();
        $this->cDel = ServidorControladores::getConDelegado();
        $this->cLic = ServidorControladores::getConLicencia();
    }

    public function nuevaAlta($idsPatinadores, $idsTecnicos, $idsDelegados, $idUser) {
        $fecha = date(DATE_W3C);
        $idsPat = json_encode($idsPatinadores);
        $idsDel = json_encode($idsDelegados);
        $idsTec = json_encode($idsTecnicos);
        try {
            ServidorControladores::getConBD()->getConexion()->query('START TRANSACTION');
            if (ServidorControladores::getConBD()->getConexion()->query("INSERT INTO alta VALUES(null,'$fecha','$idsPat','$idsTec','$idsDel','$idUser','false')")) {
                $id = $this->traerUltimoId();
                $nombre = $this->exportarAlta($id);
                $this->cNot->nuevaNotifAlta($id, $idUser);
                ServidorControladores::getConBD()->getConexion()->query('COMMIT');
                return $nombre;
            } else {
                ServidorControladores::getConBD()->getConexion()->query('ROLLBACK');
                echo ServidorControladores::getConBD()->getConexion()->error;
                return false;
            }
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function aceptarAlta($idAlta) {
        $a = $this->traerAltaXID($idAlta);
       
        if (count($a->getPatinadores()) > 0) {
            foreach ($a->getPatinadores() as $pat) {
                $tipo = $this->cLic->defineLicencia($pat->getCatEsc(), $pat->getCatLibre(), $pat->getCatSoloDance(), $pat->getCatFreeDance());
                $b = $this->cPat->creaOHabilitaLicencia($pat, $tipo);
                ServidorControladores::getConPatinador()->activoPendientes($pat->getIdPersona());
            }
        }
        if (count($a->getTecnicos()) > 0) {
            foreach ($a->getTecnicos() as $tec) {
                $b = $this->cTec->creaOHabilitaLicencia($tec, $tec->getCategoria()->getTipoLicencia());
                ServidorControladores::getConTecnico()->activoPendientes($tec->getIdPersona());
            }
        }
        if (count($a->getDelegados()) > 0) {
            foreach ($a->getDelegados() as $del) {
                $b = $this->cDel->creaOHabilitaLicencia($del, 'Delegado');
                ServidorControladores::getConDelegado()->activoPendientes($del->getIdPersona());
            }
        }
        $this->altaAtendida($idAlta);
        $this->cNot->nuevaNotifAceptAlta($a);
        return true;
    }

    public function traerAltaXID($idAlta) {
        try {
            if (!$r = ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM alta WHERE idAlta='$idAlta'")) {
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            while ($f = $r->fetch_array()) {
                $a = new Modelo\Alta($f['fecha'], $f['atendida']);
                $patinadores = array();
                $tecnicos = array();
                $delegados = array();
                $a->setIdAlta($f['idAlta']);
                $idp = json_decode($f['idsPat']);
                $idt = json_decode($f['idsTec']);
                $idd = json_decode($f['idsDel']);
                if ((count($idp) > 0) && ($idp[0] != null)) {
                    
                    foreach ($idp as $idPat) {
                       
                        array_push($patinadores, $this->cPat->traerPatinadorXID($idPat->id));
                    }
                }
                if ((count($idt) > 0) && ($idt[0] != null)) {
                    foreach ($idt as $idTec) {
                        array_push($tecnicos, $this->cTec->traerTecnicoXID($idTec->id));
                    }
                }
                if ((count($idd) > 0) && ($idd[0] != null)) {
                    foreach ($idd as $idDel) {
                        array_push($delegados, $this->cDel->traerDelegadoXID($idDel->id));
                    }
                }
                $a->setPatinadores($patinadores);
                $a->setTecnicos($tecnicos);
                $a->setDelegados($delegados);
                $a->setUser($this->cUser->traerUsuarioXID($f['idUser']));
                return $a;
            }
            
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function traerUltimoId() {
        $r = ServidorControladores::getConBD()->getConexion()->query("SELECT MAX(idAlta) AS id FROM alta")->fetch_array();
        return $r['id'];
    }

    public function altaAtendida($idAlta) {
        if (ServidorControladores::getConBD()->getConexion()->query("UPDATE alta SET atendida='true' WHERE idAlta='$idAlta'")) {
            return true;
        } else {
            die(ServidorControladores::getConBD()->getConexion()->error);
            return false;
        }
    }

    public function listarPendientes($idUs) {
        try {
            $pendientes = array();
            if ($idUs != 0) {
                if (!$r = ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM alta WHERE atendida='false' AND idUser='$idUs' ORDER BY fecha DESC")) {
                    die(ServidorControladores::getConBD()->getConexion()->error);
                }
                while ($a = $r->fetch_array()) {
                    $alta = new Modelo\Alta($a['fecha'], $a['atendida']);
                    $alta->setIdAlta($a['idAlta']);
                    $alta->setPatinadores(json_decode($a['idsPat']));
                    $alta->setDelegados(json_decode($a['idsDel']));
                    $alta->setTecnicos(json_decode($a['idsTec']));
                    $alta->setUser($a['idUser']);
                    array_push($pendientes, $alta);
                }
            } else {
                if (!$r = ServidorControladores::getConBD()->getConexion()->query('SELECT * FROM alta WHERE atendida="false" ORDER BY fecha DESC')) {
                    die(ServidorControladores::getConBD()->getConexion()->error);
                }
                while ($a = $r->fetch_array()) {
                    $alta = new Modelo\Alta($a['fecha'], $a['atendida']);
                    $alta->setIdAlta($a['idAlta']);
                    $alta->setPatinadores(json_decode($a['idsPat']));
                    $alta->setDelegados(json_decode($a['idsDel']));
                    $alta->setTecnicos(json_decode($a['idsTec']));
                    array_push($pendientes, $alta);
                }
            }
            return $pendientes;
        } catch (mysqli_sql_exception $ex) {
            die($ex->getMessage());
        }
    }

    public function exportarAlta($idAlta) {
        $alta = $this->traerAltaXID($idAlta);
        $datos = array();
        foreach ($alta->getPatinadores() as $pat) {
            array_push($datos, $pat);
        }
        foreach ($alta->getTecnicos() as $tec) {
            array_push($datos, $tec);
        }
        foreach ($alta->getDelegados() as $del) {
            array_push($datos, $del);
        }
        $excel = ServidorControladores::getConReportes()->exportarPadron($datos, $datos[0]->getClub()->getIdClub());
        $nombre = time() . '- Padron.xls';
        $exList = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        $exList->save('..\\..\\..\\Temp\\' . $nombre);
        return $nombre;
    }

}
