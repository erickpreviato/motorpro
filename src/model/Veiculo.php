<?php
/**
 * Table Definition for veiculo
 */
require_once 'DB/DataObject.php';

class Veiculo extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'veiculo';             // table name
    public $id;                             // int(4) primary_key not_null
    public $tipo_veiculo_id;                // int(4) not_null
    public $placa;                          // varchar(8)
    public $km;                             // int(4)
    public $cor;                            // varchar(45)

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
