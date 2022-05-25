<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of ItemCarregDAO
 *
 * @author anderson
 */
class ItemCargaDAO extends Conn {

    public function verifItem($idCabec, $item) {

        $select = " SELECT "
                    . " COUNT(*) AS QTDE "
                . " FROM "
                    . " USINAS.LEITURA_BAG_OC_ITEM "
                . " WHERE "
                    . " CEL_ID = " . $item->idItemCarga
                    . " AND "
                    . " LEIBGOC_ID = " . $idCabec;

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

    public function insItem($idCabecBD, $item) {
        
        $sql = "INSERT INTO USINAS.LEITURA_BAG_OC_ITEM ("
                . " LEIBGOC_ID "
                . " , REGMEDPES_ID "
                . " , CEL_ID "
                . " ) "
                . " VALUES ("
                . " " . $idCabecBD
                . " , " . $item->idRegMedPesBagCarga
                . " , " . $item->idItemCarga
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();

    }
    
}
