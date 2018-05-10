<?php
/**
 * Table Definition for usuario_oficina
 */
require_once 'DB/DataObject.php';

class Usuario_oficina extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'usuario_oficina';     // table name
    public $usuario_id;                     // int(4) primary_key not_null
    public $oficina_id;                     // int(4) primary_key not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
