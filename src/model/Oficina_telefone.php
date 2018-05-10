<?php
/**
 * Table Definition for oficina_telefone
 */
require_once 'DB/DataObject.php';

class Oficina_telefone extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'oficina_telefone';    // table name
    public $oficina_id;                     // int(4) primary_key not_null
    public $telefone_id;                    // int(4) primary_key not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
