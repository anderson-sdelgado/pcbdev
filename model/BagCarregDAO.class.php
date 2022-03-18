<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of BagDAO
 *
 * @author anderson
 */
class BagCarregDAO extends Conn {
    //put your code here
    
    public function dados($base) {

        $select = "SELECT DISTINCT "
                        . " BC.REGMEDPES_ID AS \"idRegMedPesBag\" "
                        . " , BC.NRO_BAG AS \"nroBag\" "
                        . " , BC.CD_BARRA AS \"codBarraBag\" "
                        . " , BC.EMPRUSU_ID AS \"idEmprUsuBag\" "
                        . " , BC.PERIODPROD_ID AS \"idPeriodProdBag\" "
                        . " , BC.DADOSPROD_ID AS \"idProdBag\" "
                    . " FROM "
                        . " V_BAG_CARREGAMENTO BC"
                        . " , V_ORDEM_BAG_CARREGANDO OC "
                    . " WHERE " 
                        . " OC.PERIODPROD_ID = BC.PERIODPROD_ID "
                        . " AND "
                        . " OC.DADOSPROD_ID = BC.DADOSPROD_ID "
                        . " AND "
                        . " OC.EMPRUSU_ID = BC.EMPRUSU_ID ";
        
        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
