<?php

/**
 * Table Definition for oficina_endereco
 */
require_once 'DB/DataObject.php';

class Oficina_endereco extends DB_DataObject {
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'oficina_endereco';    // table name
    public $oficina_id;                     // int(4) primary_key not_null
    public $endereco_id;                    // int(4) primary_key not_null
    public $data_atualizacao;               // datetime not_null default_0000-00-00

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    public static function salvar($oficina = null, $endereco = null) {

        $retorno = false;
        
        $oficina_endereco = new Oficina_endereco();
        $oficina_endereco->setendereco_id($endereco);
        $oficina_endereco->setoficina_id($oficina);
        $oficina_endereco->find();
        $oficina_endereco->fetch();

        if ($oficina_endereco->count() > 0) {

            $oficina_endereco->setdata_atualizacao(date('Y-m-d H:i:s'));
            
            $oficina_endereco->update();
            
            $retorno = true;
        } else {
            
            $oficina_endereco->setoficina_id($oficina);
            $oficina_endereco->setendereco_id($endereco);
            $oficina_endereco->setdata_atualizacao(date('Y-m-d H:i:s'));
            
            $oficina_endereco->insert();
            
            $retorno = true;
        }
        
        return $retorno;
    }
    
    
    public static function get_oficina($endereco = null) {
        
        $retorno = '';
        
        $oficina_endereco = new Oficina_endereco();
        $oficina_endereco->setendereco_id($endereco);
        $oficina_endereco->find();
        $oficina_endereco->fetch();
        
        if ($oficina_endereco->count() > 0) {
            $retorno = $oficina_endereco->getoficina_id();
        }
        
        return $retorno;
    }

}
