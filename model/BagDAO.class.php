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
class BagDAO extends Conn {
    //put your code here
    
    public function dadosCargaEstoqueCod($codBarra) {

        $select = " SELECT DISTINCT "
                        . " BC.REGMEDPES_ID AS \"idRegMedPesBag\" "
                        . " , BC.NRO_BAG AS \"nroBag\" "
                        . " , BC.CD_BARRA AS \"codBarraBag\" "
                        . " , BC.EMPRUSU_ID AS \"idEmprUsuBag\" "
                        . " , BC.PERIODPROD_ID AS \"idPeriodProdBag\" "
                        . " , BC.DADOSPROD_ID AS \"idProdBag\" "
                    . " FROM "
                        . " USINAS.V_BAG_CARREGAMENTO BC"
                        . " , USINAS.V_ORDEM_BAG_CARREGANDO OC "
                    . " WHERE "
                        . " BC.CD_BARRA LIKE '%" . $codBarra . "%'"
                        . " AND " 
                        . " OC.PERIODPROD_ID = BC.PERIODPROD_ID "
                        . " AND "
                        . " OC.DADOSPROD_ID = 4 "
                        . " AND "
                        . " OC.EMPRUSU_ID = 1 ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
    public function dadosCargaEstoqueNro($nroBag) {

        $select = " SELECT DISTINCT "
                        . " BC.REGMEDPES_ID AS \"idRegMedPesBag\" "
                        . " , BC.NRO_BAG AS \"nroBag\" "
                        . " , BC.CD_BARRA AS \"codBarraBag\" "
                        . " , BC.EMPRUSU_ID AS \"idEmprUsuBag\" "
                        . " , BC.PERIODPROD_ID AS \"idPeriodProdBag\" "
                        . " , BC.DADOSPROD_ID AS \"idProdBag\" "
                    . " FROM "
                        . " USINAS.V_BAG_CARREGAMENTO BC"
                        . " , USINAS.V_ORDEM_BAG_CARREGANDO OC "
                    . " WHERE "
                        . " BC.NRO_BAG = " . $nroBag
                        . " AND " 
                        . " OC.PERIODPROD_ID = BC.PERIODPROD_ID "
                        . " AND "
                        . " OC.DADOSPROD_ID = 4 "
                        . " AND "
                        . " OC.EMPRUSU_ID = 1 ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
        
    public function dadosCargaProducaoCod($codBarra) {

        $select = " SELECT DISTINCT "
                        . " BC.REGMEDPES_ID AS \"idRegMedPesBag\" "
                        . " , BC.NRO_BAG AS \"nroBag\" "
                        . " , BC.CD_BARRA AS \"codBarraBag\" "
                        . " , BC.EMPRUSU_ID AS \"idEmprUsuBag\" "
                        . " , BC.PERIODPROD_ID AS \"idPeriodProdBag\" "
                        . " , BC.DADOSPROD_ID AS \"idProdBag\" "
                    . " FROM "
                        . " USINAS.V_BAG_PEND_ESTOQ BC"
                        . " , USINAS.V_ORDEM_BAG_CARREGANDO OC "
                    . " WHERE "
                        . " BC.CD_BARRA LIKE '%" . $codBarra . "%'"
                        . " AND " 
                        . " OC.PERIODPROD_ID = BC.PERIODPROD_ID "
                        . " AND "
                        . " OC.DADOSPROD_ID = 4 "
                        . " AND "
                        . " OC.EMPRUSU_ID = 1 ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
    public function dadosCargaProducaoNro($nroBag) {

        $select = " SELECT DISTINCT "
                        . " BC.REGMEDPES_ID AS \"idRegMedPesBag\" "
                        . " , BC.NRO_BAG AS \"nroBag\" "
                        . " , BC.CD_BARRA AS \"codBarraBag\" "
                        . " , BC.EMPRUSU_ID AS \"idEmprUsuBag\" "
                        . " , BC.PERIODPROD_ID AS \"idPeriodProdBag\" "
                        . " , BC.DADOSPROD_ID AS \"idProdBag\" "
                    . " FROM "
                        . " USINAS.V_BAG_PEND_ESTOQ BC"
                        . " , USINAS.V_ORDEM_BAG_CARREGANDO OC "
                    . " WHERE "
                        . " BC.NRO_BAG = " . $nroBag
                        . " AND " 
                        . " OC.PERIODPROD_ID = BC.PERIODPROD_ID "
                        . " AND "
                        . " OC.DADOSPROD_ID = 4 "
                        . " AND "
                        . " OC.EMPRUSU_ID = 1 ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
    public function dadosTransfCod($codBarra, $idSafra) {

        $select = "SELECT DISTINCT "
                        . " B.REGMEDPES_ID AS \"idRegMedPesBag\" "
                        . " , B.NRO_BAG AS \"nroBag\" "
                        . " , B.CD_BARRA AS \"codBarraBag\" "
                    . " FROM "
                        . " USINAS.V_BAG_ESTOQ B "
                    . " WHERE " 
                        . " B.CD_BARRA LIKE '%" . $codBarra . "%'"
                        . " AND " 
                        . " B.PERIODPROD_ID = " . $idSafra
                        . " AND "
                        . " B.DADOSPROD_ID = 4 "
                        . " AND "
                        . " B.EMPRUSU_ID = 1 ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
    public function dadosTransfNro($nroBag, $idSafra) {

        $select = "SELECT DISTINCT "
                        . " B.REGMEDPES_ID AS \"idRegMedPesBag\" "
                        . " , B.NRO_BAG AS \"nroBag\" "
                        . " , B.CD_BARRA AS \"codBarraBag\" "
                    . " FROM "
                        . " USINAS.V_BAG_ESTOQ B "
                    . " WHERE " 
                        . " B.NRO_BAG = " . $nroBag
                        . " AND " 
                        . " B.PERIODPROD_ID = " . $idSafra
                        . " AND "
                        . " B.DADOSPROD_ID = 4 "
                        . " AND "
                        . " B.EMPRUSU_ID = 1 ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
