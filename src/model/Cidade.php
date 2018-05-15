<?php
/**
 * Table Definition for cidade
 */
require_once 'DB/DataObject.php';

class Cidade extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'cidade';              // table name
    public $id;                             // int(4) primary_key not_null
    public $nome;                           // varchar(150) not_null
    public $ddd;                            // varchar(4)
    public $estado_id;                      // int(4) not_null
    public $situacao;                       // char(1)

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
