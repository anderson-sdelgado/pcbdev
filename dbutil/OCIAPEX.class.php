<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OCI
 *
 * @author anderson
 */
class OCIAPEX {
    //put your code here
    
    /** @var PDO */
    private static $Connect = null;

    /**
     * Conecta com o banco de dados com o pattern singleton.
     * Retorna um objeto PDO!
     */
    private static function Conectar() {
        try {

            if (self::$Connect == null) {

                $tns = "(DESCRIPTION =
                            (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.2.10)(PORT = 1521))
                            (CONNECT_DATA =
                              (SERVER = DEDICATED)
                              (SERVICE_NAME = APEXDEV)
                            )
                          )";

                self::$Connect = oci_connect('STAFE', 'STA1553', $tns, 'AL32UTF8');
                
            }
        } catch (PDOException $e) {
            PHPErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            die;
        }

        return self::$Connect;
    }

    protected static function getConn() {
        return self::Conectar();
    }
    
}
