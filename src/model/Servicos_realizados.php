<?php
/**
 * Table Definition for servicos_realizados
 */
require_once 'DB/DataObject.php';

class Servicos_realizados extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'servicos_realizados';    // table name
    public $servico_id;                     // int(4) primary_key not_null
    public $ordem_servico_id;               // int(4) primary_key not_null
    public $funcionario_id;                 // int(4)
    public $descricao;                      // text

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
