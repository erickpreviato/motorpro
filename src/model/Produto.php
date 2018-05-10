<?php
/**
 * Table Definition for produto
 */
require_once 'DB/DataObject.php';

class Produto extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'produto';             // table name
    public $id;                             // int(4) primary_key not_null
    public $descricao;                      // varchar(200) not_null
    public $valor;                          // double
    public $valor_venda;                    // double
    public $quantidade;                     // int(4)
    public $estoque_minimo;                 // int(4)
    public $produto_marca_id;               // int(4) not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
