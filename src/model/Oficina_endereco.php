<?php
/**
 * Table Definition for oficina_endereco
 */
require_once 'DB/DataObject.php';

class Oficina_endereco extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'oficina_endereco';    // table name
    public $oficina_id;                     // int(4) primary_key not_null
    public $endereco_id;                    // int(4) primary_key not_null
    public $data_atualizacao;               // datetime not_null default_0000-00-00%2000%3A00%3A00

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
