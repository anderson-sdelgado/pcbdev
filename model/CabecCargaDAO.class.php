<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of CabecCarregDAO
 *
 * @author anderson
 */
class CabecCargaDAO extends Conn {

    public function verifCabec($cabec) {

        $select = " SELECT "
                        . " COUNT(*) AS QTDE "
                    . " FROM "
                        . " USINAS.LEITURA_BAG_OC "
                    . " WHERE "
                        . " DT_HR = TO_DATE('" . $cabec->dthrCabecCarga . "','DD/MM/YYYY HH24:MI')"
                    . " AND "
                        . " CEL_ID = " . $cabec->idCabecCarga;

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $v = $item['QTDE'];
        }

        return $v;
    }

    public function idCabec($cabec) {

        $select = " SELECT "
                        . " LEIBGOC_ID AS ID "
                    . " FROM "
                        . " USINAS.LEITURA_BAG_OC "
                    . " WHERE "
                        . " DT_HR = TO_DATE('" . $cabec->dthrCabecCarga . "','DD/MM/YYYY HH24:MI')"
                    . " AND "
                        . " CEL_ID = " . $cabec->idCabecCarga;

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $id = $item['ID'];
        }

        return $id;
    }

    public function insCabecAberto($cabec) {

        $sql = "INSERT INTO USINAS.LEITURA_BAG_OC ("
                            . " ORDCARREG_ID "
                            . " , FUNC_ID "
                            . " , DT_HR "
                            . " , CEL_ID "
                            . " , STATUS "
                            . " , DIRETO_PROD "
                        . " ) "
                        . " VALUES ("
                            . " " . $cabec->idOrdemCabecCarga
                            . " , " . $cabec->idFuncCabecCarga
                            . " , TO_DATE('" . $cabec->dthrCabecCarga . "','DD/MM/YYYY HH24:MI')"
                            . " , " . $cabec->idCabecCarga
                            . " , 1 "
                            . " , " . $cabec->tipoCabecCarga
                        . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    public function insCabecFechado($cabec) {

        $sql = "INSERT INTO USINAS.LEITURA_BAG_OC ("
                            . " ORDCARREG_ID "
                            . " , FUNC_ID "
                            . " , DT_HR "
                            . " , CEL_ID "
                            . " , STATUS "
                            . " , DIRETO_PROD "
                        . " ) "
                        . " VALUES ("
                            . " " . $cabec->idOrdemCabecCarga
                            . " , " . $cabec->idFuncCabecCarga
                            . " , TO_DATE('" . $cabec->dthrCabecCarga . "','DD/MM/YYYY HH24:MI')"
                            . " , " . $cabec->idCabecCarga
                            . " , 2 "
                            . " , " . $cabec->tipoCabecCarga
                        . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    public function updateCabecFechado($idCabecBD) {

        $sql = "UPDATE USINAS.LEITURA_BAG_OC "
                        . " SET "
                        . " STATUS = 2 "
                        . " WHERE "
                        . " LEIBGOC_ID = " . $idCabecBD;

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }
    
}
