<?php
/**
 * Table Definition for endereco
 */
require_once 'DB/DataObject.php';

class Endereco extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'endereco';            // table name
    public $id;                             // int(4) primary_key not_null
    public $tipo;                           // varchar(50)
    public $logradouro;                     // varchar(200) not_null
    public $numero;                         // varchar(15)
    public $bairro;                         // varchar(200)
    public $cep;                            // varchar(45)
    public $cidade_id;                      // int(4) not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
