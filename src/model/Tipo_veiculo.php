<?php
/**
 * Table Definition for tipo_veiculo
 */
require_once 'DB/DataObject.php';

class Tipo_veiculo extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'tipo_veiculo';        // table name
    public $id;                             // int(4) primary_key not_null
    public $descricao;                      // varchar(45) not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    
    
    public static function get_campo($ID = null, $campo = null) {
        
        $tipoVeiculo = new Tipo_veiculo();
        $tipoVeiculo->get($ID);
        
        return $tipoVeiculo->$campo;
    }
    
    
    public static function get_options($ID = null) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/tipo_veiculo");
        $pagina = 'option.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('HOME', HOME);

        $tipoVeiculo = new Tipo_veiculo();
        $tipoVeiculo->find();

        while ($tipoVeiculo->fetch()) {

            $tpl->setVariable('ID', $tipoVeiculo->id);
            $tpl->setVariable('NOME', 'tipo_veiculo_id');
            $tpl->setVariable('VALOR', $tipoVeiculo->descricao);
            $tpl->setVariable('SELECTED', $tipoVeiculo->id == $ID ? 'selected="selected"' : '');

            $tpl->parse('option');
        }

        return $tpl->get();
    }
}
