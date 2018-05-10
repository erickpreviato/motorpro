<?php
/**
 * Table Definition for tipo_veiculo_servico
 */
require_once 'DB/DataObject.php';

class Tipo_veiculo_servico extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'tipo_veiculo_servico';    // table name
    public $tipo_veiculo_id;                // int(4) primary_key not_null
    public $servico_id;                     // int(4) primary_key not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
