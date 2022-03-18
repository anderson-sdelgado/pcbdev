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
class OrdemCarregDAO extends Conn {
    //put your code here
    
    public function dados($base) {

        $select = " SELECT "
                        . " VOC.ORDCARREG_ID AS \"idOrdemCarreg\" "
                        . " , DECODE(VOC.DEST_EXP, 'SIM', 1, 2) AS \"destExpOrdemCarreg\" "
                        . " , VOC.TICKET AS \"ticketOrdemCarreg\" "
                        . " , VOC.PRODUTO AS \"produtoOrdemCarreg\" "
                        . " , VOC.CLASSIF AS \"classifOrdemCarreg\" "
                        . " , VOC.QT_EMBAL AS \"qtdeEmbProdOrdemCarreg\" "
                        . " , VOC.PERIODPROD_ID AS \"idPeriodProdOrdemCarreg\" "
                        . " , VOC.EMPRUSU_ID AS \"idEmprUsuOrdemCarreg\" "
                        . " , VOC.DADOSPROD_ID AS \"idProdOrdemCarreg\" "
                    . " FROM " 
                        . " V_ORDEM_BAG_CARREGANDO VOC "
                    . " WHERE NOT EXISTS "
                            . " (SELECT "
                                    . " 1 "
                                . " FROM "
                                    . " LEITURA_BAG_OC LB "
                                . " WHERE"
                                    . " LB.ORDCARREG_ID = VOC.ORDCARREG_ID)";
        
        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
