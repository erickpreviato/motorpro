<?php

/**
 * Table Definition for pais
 */
require_once 'DB/DataObject.php';

class Pais extends DB_DataObject {
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'pais';                // table name
    public $id;                             // int(4) primary_key not_null
    public $nome;                           // varchar(150) not_null
    public $codigo;                         // varchar(10)

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    public function showAll() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/pais");
        $pagina = 'list.tpl.html';
        $tpl->loadTemplateFile($pagina);
        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);

        $tpl->setVariable('HOME', HOME);

        $i = 0;

        while ($this->fetch()) {

            $tpl->setVariable('ID', $this->id);
            $tpl->setVariable('CODIGO', $this->codigo);
            $tpl->setVariable('NOME', $this->nome);
            $acao = '<button data-toggle="tooltip" title="Editar" value="' . $this->id . '" class="btn btn-xs btn-default btn-form"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
            $tpl->setVariable('ACOES', $acao);
            $tpl->parse('table_row');
            $i++;
        }

        if ($i == 0) {
            $tpl->setVariable("NONE", "Nenhum País cadastrado.");
            $tpl->touchBlock("row_none");
            $tpl->hideBlock("datatable");
        } else {
            $tpl->setVariable('Classe', 'listagem');
            $tpl->touchBlock("datatable");
        }

        return $tpl->get();
    }

    public function showForm() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/pais");
        $pagina = 'form.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);

        $tpl->setVariable('HOME', HOME);

        $tpl->setVariable('ID', $this->id);
        $tpl->setVariable('NOME', $this->nome);
        $tpl->setVariable('CODIGO', $this->codigo);

        return $tpl->get();
    }

}
