<?php
/**
 * Table Definition for tipo_veiculo_produto
 */
require_once 'DB/DataObject.php';

class Tipo_veiculo_produto extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'tipo_veiculo_produto';    // table name
    public $produto_id;                     // int(4) primary_key not_null
    public $tipo_veiculo_id;                // int(4) primary_key not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
