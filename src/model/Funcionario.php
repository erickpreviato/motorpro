<?php
/**
 * Table Definition for funcionario
 */
require_once 'DB/DataObject.php';

class Funcionario extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'funcionario';         // table name
    public $id;                             // int(4) primary_key not_null
    public $oficina_id;                     // int(4) not_null
    public $nome;                           // varchar(100) not_null
    public $data_exclusao;                  // datetime

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
