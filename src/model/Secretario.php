<?php
/**
 * Table Definition for secretario
 */
require_once 'DB/DataObject.php';

class Secretario extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'secretario';          // table name
    public $oficina_id;                     // int(4) primary_key not_null
    public $usuario_id;                     // int(4) primary_key not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
