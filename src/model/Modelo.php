<?php
/**
 * Table Definition for modelo
 */
require_once 'DB/DataObject.php';

class Modelo extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'modelo';              // table name
    public $id;                             // int(4) primary_key not_null
    public $marca_id;                       // int(4) not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    
    
    public static function get_options($ID = null) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/modelo");
        $pagina = 'option.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('HOME', HOME);

        $modelo = new Modelo();
        $modelo->find();

        while ($modelo->fetch()) {

            $tpl->setVariable('ID', $modelo->id);
            $tpl->setVariable('NOME', 'modelo');
            $tpl->setVariable('VALOR', $modelo->marca_id);
            $tpl->setVariable('SELECTED', $modelo->id == $ID ? 'selected="selected"' : '');

            $tpl->parse('option');
        }

        return $tpl->get();
    }
}
