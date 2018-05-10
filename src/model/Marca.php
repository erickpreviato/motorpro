<?php
/**
 * Table Definition for marca
 */
require_once 'DB/DataObject.php';

class Marca extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'marca';               // table name
    public $id;                             // int(4) primary_key not_null
    public $tipo_veiculo_id;                // int(4) not_null
    public $codigo_fipe;                    // int(4)

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
