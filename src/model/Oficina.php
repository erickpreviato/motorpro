<?php
/**
 * Table Definition for oficina
 */
require_once 'DB/DataObject.php';

class Oficina extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'oficina';             // table name
    public $id;                             // int(4) primary_key not_null
    public $nome;                           // varchar(250) not_null
    public $cnpj;                           // varchar(45)
    public $razao_social;                   // varchar(250)
    public $inscricao_estadual;             // varchar(45)

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
