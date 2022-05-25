<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/CabecCargaDAO.class.php');
require_once('../model/ItemCargaDAO.class.php');
/**
 * Description of CarregCTR
 *
 * @author anderson
 */
class CargaCTR {

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
        
        $cabecCargaDAO = new CabecCargaDAO();
        $idCabecArray = array();
        
        foreach ($cabecDados as $cabec) {
            $v = $cabecCargaDAO->verifCabec($cabec);
            if ($v == 0) {
                $cabecCargaDAO->insCabecFechado($cabec);
                $idCabecBD = $cabecCargaDAO->idCabec($cabec);
            } else {
                $idCabecBD = $cabecCargaDAO->idCabec($cabec);
                $cabecCargaDAO->updateCabecFechado($idCabecBD, $cabec);
            }
            $this->salvarItem($idCabecBD, $cabec->idCabecCarga, $itemDados);
            $idCabecArray[] = array("idCabecCarga" => $cabec->idCabecCarga);
        }
        $cabecRet = json_encode(array("cabec"=>$idCabecArray));
        return 'CARGA_' . $cabecRet;
        
    }
    
    private function salvarItem($idCabecBD, $idCabecCel, $itemDados){
        $itemCargaDAO = new ItemCargaDAO;
        foreach ($itemDados as $item) {
            if ($idCabecCel == $item->idCabecCarga) {
                $v = $itemCargaDAO->verifItem($idCabecBD, $item);
                if ($v == 0) {
                    $itemCargaDAO->insItem($idCabecBD, $item);
                }
            }
        }
    }
    
}
