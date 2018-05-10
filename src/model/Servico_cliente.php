<?php
/**
 * Table Definition for servico_cliente
 */
require_once 'DB/DataObject.php';

class Servico_cliente extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'servico_cliente';     // table name
    public $id;                             // int(4) primary_key not_null
    public $servico;                        // varchar(150)

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
