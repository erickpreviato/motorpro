<?php
/**
 * Table Definition for usuario
 */
require_once 'DB/DataObject.php';

class Usuario extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'usuario';             // table name
    public $id;                             // int(4) primary_key not_null
    public $email;                          // varchar(100) not_null
    public $senha;                          // varchar(100)
    public $data_criacao;                   // datetime
    public $data_ultimo_login;              // datetime
    public $ip_ultimo_login;                // varchar(45)

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
