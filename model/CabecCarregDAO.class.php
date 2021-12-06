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
class CabecCarregDAO extends Conn {

    public function verifCabec($cabec, $base) {

        $select = " SELECT "
                        . " COUNT(*) AS QTDE "
                    . " FROM "
                        . " LEITURA_BAG_OC "
                    . " WHERE "
                        . " DT_HR = TO_DATE('" . $cabec->dthrCabecCarreg . "','DD/MM/YYYY HH24:MI')"
                    . " AND "
                        . " CEL_ID = " . $cabec->idCabecCarreg;

        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $v = $item['QTDE'];
        }

        return $v;
    }

    public function idCabec($cabec, $base) {

        $select = " SELECT "
                        . " LEIBGOC_ID AS ID "
                    . " FROM "
                        . " LEITURA_BAG_OC "
                    . " WHERE "
                        . " DT_HR = TO_DATE('" . $cabec->dthrCabecCarreg . "','DD/MM/YYYY HH24:MI')"
                    . " AND "
                        . " CEL_ID = " . $cabec->idCabecCarreg;

        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $id = $item['ID'];
        }

        return $id;
    }

    public function insCabecAberto($cabec, $base) {

        $sql = "INSERT INTO LEITURA_BAG_OC ("
                    . " ORDCARREG_ID "
                    . " , FUNC_ID "
                    . " , DT_HR "
                    . " , CEL_ID "
                    . " , STATUS "
                    . " ) "
                    . " VALUES ("
                    . " " . $cabec->idOrdemCabecCarreg
                    . " , " . $cabec->idFuncCabecCarreg
                    . " , TO_DATE('" . $cabec->dthrCabecCarreg . "','DD/MM/YYYY HH24:MI')"
                    . " , " . $cabec->idCabecCarreg
                    . " , 1 "
                    . " )";

        $this->Conn = parent::getConn($base);
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    public function insCabecFechado($cabec, $base) {

        $sql = "INSERT INTO LEITURA_BAG_OC ("
                    . " ORDCARREG_ID "
                    . " , FUNC_ID "
                    . " , DT_HR "
                    . " , CEL_ID "
                    . " , STATUS "
                    . " ) "
                    . " VALUES ("
                    . " " . $cabec->idOrdemCabecCarreg
                    . " , " . $cabec->idFuncCabecCarreg
                    . " , TO_DATE('" . $cabec->dthrCabecCarreg . "','DD/MM/YYYY HH24:MI')"
                    . " , " . $cabec->idCabecCarreg
                    . " , 2 "
                    . " )";

        $this->Conn = parent::getConn($base);
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    public function updateCabecFechado($idCabecBD, $cabec, $base) {

        $sql = "UPDATE LEITURA_BAG_OC "
                    . " SET "
                    . " STATUS = 2 "
                    . " WHERE "
                    . " LEIBGOC_ID = " . $idCabecBD;

        $this->Conn = parent::getConn($base);
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }
    
}
