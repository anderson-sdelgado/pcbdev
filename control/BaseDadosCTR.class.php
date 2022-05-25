<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/AtualOrdemCargaDAO.class.php');
require_once('../model/BagDAO.class.php');
require_once('../model/FuncDAO.class.php');
require_once('../model/OrdemCargaDAO.class.php');
/**
 * Description of BaseDadosCTR
 *
 * @author anderson
 */
class BaseDadosCTR {

    public function dadosBagCarga() {

        $bagDAO = new BagDAO();

        $dados = array("dados"=>$bagDAO->dadosCarga());
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    public function dadosFunc() {

        $funcDAO = new FuncDAO();

        $dados = array("dados"=>$funcDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    public function dadosOrdemCarga() {

        $atualOrdemCargaDAO = new AtualOrdemCargaDAO();
        $ordemCargaDAO = new OrdemCargaDAO();

        $atualOrdemCargaDAO->atualOrdemCarga();
        $dados = array("dados"=>$ordemCargaDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;

    }
    
    public function dadosBagTransf($info) {

        $bagDAO = new BagDAO();

        $dados = array("dados"=>$bagDAO->dadosTransf($info['dado']));
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
}
