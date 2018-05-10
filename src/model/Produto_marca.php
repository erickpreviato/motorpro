<?php
/**
 * Table Definition for produto_marca
 */
require_once 'DB/DataObject.php';

class Produto_marca extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'produto_marca';       // table name
    public $id;                             // int(4) primary_key not_null
    public $nome;                           // varchar(150) not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
