<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of OrdemCarregDAO
 *
 * @author anderson
 */
class OrdemCargaDAO extends Conn {
    //put your code here
    
    public function dados() {

        $select = " SELECT "
                        . " VOC.ORDCARREG_ID AS \"idOrdemCarga\" "
                        . " , DECODE(VOC.DEST_EXP, 'SIM', 1, 2) AS \"destExpOrdemCarga\" "
                        . " , VOC.TICKET AS \"ticketOrdemCarga\" "
                        . " , VOC.PRODUTO AS \"produtoOrdemCarga\" "
                        . " , VOC.CLASSIF AS \"classifOrdemCarga\" "
                        . " , VOC.QT_EMBAL AS \"qtdeEmbProdOrdemCarga\" "
                        . " , VOC.PERIODPROD_ID AS \"idPeriodProdOrdemCarga\" "
                        . " , VOC.EMPRUSU_ID AS \"idEmprUsuOrdemCarga\" "
                        . " , VOC.DADOSPROD_ID AS \"idProdOrdemCarga\" "
                    . " FROM " 
                        . " USINAS.V_ORDEM_BAG_CARREGANDO VOC "
                    . " WHERE NOT EXISTS "
                            . " (SELECT "
                                    . " 1 "
                                . " FROM "
                                    . " USINAS.LEITURA_BAG_OC LB "
                                . " WHERE"
                                    . " LB.ORDCARREG_ID = VOC.ORDCARREG_ID)";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
