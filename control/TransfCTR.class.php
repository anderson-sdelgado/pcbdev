<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../model/CabecTransfDAO.class.php');
require_once('../model/ItemTransfDAO.class.php');
/**
 * Description of TransfCTR
 *
 * @author anderson
 */
class TransfCTR {

    public function salvarDados($info) {

        $dados = $info['dado'];
        $pos1 = strpos($dados, "_") + 1;

        $cabec = substr($dados, 0, ($pos1 - 1));
        $item = substr($dados, $pos1);

        $cabecJsonObj = json_decode($cabec);
        $itemJsonObj = json_decode($item);

        $cabecDados = $cabecJsonObj->cabec;
        $itemDados = $itemJsonObj->item;

        $ret = $this->salvarCabec($cabecDados, $itemDados);

        return $ret;

    }
    
    private function salvarCabec($cabecDados, $itemDados) {
        
        $cabecTransfDAO = new CabecTransfDAO();
        $idTransfArray = array();
        
        foreach ($cabecDados as $cabec) {
            $v = $cabecTransfDAO->verifCabec($cabec);
            if ($v == 0) {
                $cabecTransfDAO->insCabecFechado($cabec);
                $idCabecBD = $cabecTransfDAO->idCabec($cabec);
            } else {
                $idCabecBD = $cabecTransfDAO->idCabec($cabec);
                $cabecTransfDAO->updateCabecFechado($idCabecBD, $cabec);
            }
            $this->salvarItem($idCabecBD, $cabec->idCabecTransf, $itemDados);
            $idCabecArray[] = array("idCabecTransf" => $cabec->idCabecTransf);
        }
        $cabecRet = json_encode(array("cabec"=>$idCabecArray));
        return 'TRANSF_' . $cabecRet;
        
    }
    
    private function salvarItem($idCabecBD, $idCabecCel, $itemDados){
        $itemTransfDAO = new ItemTransfDAO;
        foreach ($itemDados as $item) {
            if ($idCabecCel == $item->idCabecTransf) {
                $v = $itemTransfDAO->verifItem($idCabecBD, $item);
                if ($v == 0) {
                    $itemTransfDAO->insItem($idCabecBD, $item);
                }
            }
        }
    }
    
}
