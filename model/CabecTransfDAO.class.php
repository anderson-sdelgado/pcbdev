<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of CabecTransfDAO
 *
 * @author anderson
 */
class CabecTransfDAO extends Conn {

    public function verifCabec($cabec) {

        $select = " SELECT "
                        . " COUNT(*) AS QTDE "
                    . " FROM "
                        . " USINAS.LEITURA_BAG_TRANSF "
                    . " WHERE "
                        . " DT_HR = TO_DATE('" . $cabec->dthrCabecTransf . "','DD/MM/YYYY HH24:MI')"
                    . " AND "
                        . " CEL_ID = " . $cabec->idCabecTransf;

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
                        . " LEIBTRANSF_ID AS ID "
                    . " FROM "
                        . " USINAS.LEITURA_BAG_TRANSF "
                    . " WHERE "
                        . " DT_HR = TO_DATE('" . $cabec->dthrCabecTransf . "','DD/MM/YYYY HH24:MI')"
                    . " AND "
                        . " CEL_ID = " . $cabec->idCabecTransf;

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

        $sql = "INSERT INTO USINAS.LEITURA_BAG_TRANSF ("
                            . " FUNC_ID "
                            . " , DT_HR "
                            . " , CEL_ID "
                            . " , STATUS "
                            . " , DADOSPROD_ID "
                        . " ) "
                        . " VALUES ("
                            . " " . $cabec->idFuncCabecTransf
                            . " , TO_DATE('" . $cabec->dthrCabecTransf . "','DD/MM/YYYY HH24:MI')"
                            . " , " . $cabec->idCabecTransf
                            . " , 1 "
                            . " , 4 "
                        . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    public function insCabecFechado($cabec) {

        $sql = "INSERT INTO USINAS.LEITURA_BAG_TRANSF ("
                            . " FUNC_ID "
                            . " , DT_HR "
                            . " , CEL_ID "
                            . " , STATUS "
                            . " , DADOSPROD_ID "
                        . " ) "
                        . " VALUES ("
                            . " " . $cabec->idFuncCabecTransf
                            . " , TO_DATE('" . $cabec->dthrCabecTransf . "','DD/MM/YYYY HH24:MI')"
                            . " , " . $cabec->idCabecTransf
                            . " , 2 "
                            . " , 4 "
                        . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    public function updateCabecFechado($idCabecBD) {

        $sql = "UPDATE USINAS.LEITURA_BAG_TRANSF "
                        . " SET "
                        . " STATUS = 2 "
                        . " WHERE "
                        . " LEIBTRANSF_ID = " . $idCabecBD;

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }
    
}
