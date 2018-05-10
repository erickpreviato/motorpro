<?php
/**
 * Table Definition for veiculo_servico_cliente
 */
require_once 'DB/DataObject.php';

class Veiculo_servico_cliente extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'veiculo_servico_cliente';    // table name
    public $id;                             // int(4) primary_key not_null
    public $usuario_id;                     // int(4) not_null
    public $servico_cliente_id;             // int(4) not_null
    public $veiculo_id;                     // int(4) not_null
    public $data;                           // datetime
    public $descricao;                      // text
    public $km;                             // int(4)
    public $valor;                          // double

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
