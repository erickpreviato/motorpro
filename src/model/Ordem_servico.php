<?php
/**
 * Table Definition for ordem_servico
 */
require_once 'DB/DataObject.php';

class Ordem_servico extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'ordem_servico';       // table name
    public $id;                             // int(4) primary_key not_null
    public $veiculo_id;                     // int(4) not_null
    public $servico_id;                     // int(4) not_null
    public $oficina_id;                     // int(4) not_null
    public $cliente_id;                     // int(4) not_null
    public $usuario_id;                     // int(4) not_null
    public $data;                           // datetime not_null default_0000-00-00%2000%3A00%3A00
    public $observacao;                     // text

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
