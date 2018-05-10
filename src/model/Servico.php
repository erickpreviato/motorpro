<?php
/**
 * Table Definition for servico
 */
require_once 'DB/DataObject.php';

class Servico extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'servico';             // table name
    public $id;                             // int(4) primary_key not_null
    public $servico;                        // varchar(150) not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
