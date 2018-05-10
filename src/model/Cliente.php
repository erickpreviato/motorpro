<?php
/**
 * Table Definition for cliente
 */
require_once 'DB/DataObject.php';

class Cliente extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'cliente';             // table name
    public $id;                             // int(4) primary_key not_null
    public $usuario_id;                     // int(4) not_null
    public $nome;                           // varchar(100) not_null
    public $nome_social;                    // varchar(100)
    public $sexo;                           // varchar(1)
    public $data_nascimento;                // datetime
    public $cpf;                            // varchar(12)

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
