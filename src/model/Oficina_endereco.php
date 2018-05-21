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
    public $endereco_id;                    // int(4) not_null
    public $data_atualizacao;               // datetime not_null default_0000-00-00%2000%3A00%3A00

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    public static function salvar($oficina = null, $endereco = null) {

        //$retorno = false;

        $oficina_endereco = new Oficina_endereco();
        $oficina_endereco->setoficina_id($oficina);
        $oficina_endereco->find();
        $oficina_endereco->fetch();
        
        if ($oficina_endereco->count() > 0) {
            
            $oficina_endereco->setendereco_id($endereco);
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

    public static function get_endereco($oficina = null) {

        $retorno = '';

        $oficina_endereco = new Oficina_endereco();
        $oficina_endereco->setoficina_id($oficina);
        $oficina_endereco->orderBy('data_atualizacao desc');
        $oficina_endereco->limit(0, 1);
        $oficina_endereco->find();
        $oficina_endereco->fetch();

        if ($oficina_endereco->count() > 0) {
            $retorno = $oficina_endereco->getendereco_id();
        }

        return $retorno;
    }

}
