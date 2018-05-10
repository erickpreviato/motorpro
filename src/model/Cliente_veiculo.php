<?php
/**
 * Table Definition for cliente_veiculo
 */
require_once 'DB/DataObject.php';

class Cliente_veiculo extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'cliente_veiculo';     // table name
    public $cliente_id;                     // int(4) primary_key not_null
    public $veiculo_id;                     // int(4) primary_key not_null
    public $data_cadastro;                  // datetime
    public $data_exclusao;                  // datetime

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
