<?php
/**
 * Table Definition for item
 */
require_once 'DB/DataObject.php';

class Item extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'item';                // table name
    public $ordem_servico_id;               // int(4) primary_key not_null
    public $produto_id;                     // int(4) primary_key not_null
    public $quantidade;                     // int(4) not_null default_1

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
