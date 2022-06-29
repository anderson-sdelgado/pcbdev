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
require_once('../model/SafraDAO.class.php');
/**
 * Description of BaseDadosCTR
 *
 * @author anderson
 */
class BaseDadosCTR {

    public function dadosBagCargaCod($info) {

        $bagDAO = new BagDAO();

        $dados = array("dados"=>$bagDAO->dadosCargaCod($info['dado']));
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    public function dadosBagCargaNro($info) {

        $bagDAO = new BagDAO();

        $dados = array("dados"=>$bagDAO->dadosCargaNro($info['dado']));
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    public function dadosBagTransfCod($info) {

        $bagDAO = new BagDAO();
        
        $dados = $info['dado'];
        $array = explode("_",$dados);

        $dados = array("dados"=>$bagDAO->dadosTransfCod($array[0], $array[1]));
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    public function dadosBagTransfNro($info) {

        $bagDAO = new BagDAO();
        
        $dados = $info['dado'];
        $array = explode("_",$dados);

        $dados = array("dados"=>$bagDAO->dadosTransfNro($array[0], $array[1]));
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
    
    public function dadosSafra() {

        $safraDAO = new SafraDAO();

        $dados = array("dados"=>$safraDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
}
