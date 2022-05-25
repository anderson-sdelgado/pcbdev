<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of ItemTransfDAO
 *
 * @author anderson
 */
class ItemTransfDAO extends Conn {

    public function verifItem($idCabec, $item) {

        $select = " SELECT "
                    . " COUNT(*) AS QTDE "
                . " FROM "
                    . " USINAS.LEITURA_BAG_TRANSF_ITEM "
                . " WHERE "
                    . " CEL_ID = " . $item->idItemTransf
                    . " AND "
                    . " LEIBTRANSF_ID = " . $idCabec;

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
        
        $sql = "INSERT INTO USINAS.LEITURA_BAG_TRANSF_ITEM ("
                . " LEIBTRANSF_ID "
                . " , REGMEDPES_ID "
                . " , CEL_ID "
                . " ) "
                . " VALUES ("
                . " " . $idCabecBD
                . " , " . $item->idRegMedPesBagTransf
                . " , " . $item->idItemTransf
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();

    }
    
}
