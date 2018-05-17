<?php

/**
 * Table Definition for oficina
 */
require_once 'DB/DataObject.php';

class Oficina extends DB_DataObject {
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'oficina';             // table name
    public $id;                             // int(4) primary_key not_null
    public $nome;                           // varchar(250) not_null
    public $cnpj;                           // varchar(45)
    public $razao_social;                   // varchar(250)
    public $inscricao_estadual;             // varchar(45)

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    public static function get_option($ID = null) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/oficina");
        $pagina = 'option.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('HOME', HOME);

        $oficina = new Oficina();
        $oficina->find();

        while ($oficina->fetch()) {

            $tpl->setVariable('ID', $oficina->id);
            $tpl->setVariable('NOME', 'oficina');
            $tpl->setVariable('VALOR', $oficina->nome);
            $tpl->setVariable('SELECTED', $oficina->id == $ID ? 'selected="selected"' : '');

            $tpl->parse('option');
        }

        return $tpl->get();
    }

    public static function get_oficina($ID = null, $campo = null) {

        $oficina = new Oficina();
        $oficina->get($ID);

        return $oficina->$campo;
    }

    public function showAll() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/oficina");
        $pagina = 'list.tpl.html';
        $tpl->loadTemplateFile($pagina);
        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);

        $tpl->setVariable('HOME', HOME);

        $i = 0;

        while ($this->fetch()) {

            $tpl->setVariable('ID', $this->id);
            $tpl->setVariable('NOME', $this->nome);
            $tpl->setVariable('CNPJ', $this->cnpj);
            $tpl->setVariable('RAZAO_SOCIAL', $this->razao_social);
            $tpl->setVariable('INSCRICAO_ESTADUAL', $this->inscricao_estadual);


            $acao = '<button data-toggle="tooltip" title="Editar" value="' . $this->id . '" class="btn btn-xs btn-default btn-form"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';

            $acao .= '<button data-toggle="tooltip" title="Ver mais detalhes" value="' . $this->id . '" class="btn btn-xs btn-default btn-details"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button> ';
            $tpl->setVariable('ACOES', $acao);
            $tpl->parse('table_row');
            $i++;
        }

        if ($i == 0) {
            $tpl->setVariable("NONE", "Nenhuma oficina cadastrada.");
            $tpl->touchBlock("row_none");
            $tpl->hideBlock("datatable");
        } else {
            $tpl->setVariable('Classe', 'listagem');
            $tpl->touchBlock("datatable");
        }

        return $tpl->get();
    }

    public function showForm() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/oficina");
        $pagina = 'form.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('HOME', HOME);
        
        $tpl->setVariable('ID', $this->id);
        $tpl->setVariable('NOME', $this->nome);
        $tpl->setVariable('RAZAO_SOCIAL', $this->razao_social);
        $tpl->setVariable('CNPJ', $this->cnpj);
        $tpl->setVariable('INSCRICAO_ESTADUAL', $this->inscricao_estadual);

        $botao = (empty($this->id)) ? 'cadastrar' : 'editar';
        $tpl->setVariable('BOTAO', $botao);

        return $tpl->get();
    }

    public function showDetails() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/oficina");
        $pagina = 'details.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        $tpl->setVariable('ID', $this->id);
        $tpl->setVariable('NOME', $this->nome);
        $tpl->setVariable('RAZAO_SOCIAL', $this->razao_social);
        $tpl->setVariable('CNPJ', $this->cnpj);
        $tpl->setVariable('INSCRICAO_ESTADUAL', $this->inscricao_estadual);

        return $tpl->get();
    }

    
    public function setDados($post) {
        $this->nome = (isset($post['nome'])) ? $post['nome'] : $this->nome;
        $this->razao_social = (isset($post['razao_social'])) ? $post['razao_social'] : $this->razao_social;
        $this->cnpj = (isset($post['cnpj'])) ? $post['cnpj'] : $this->cnpj;
        $this->inscricao_estadual = (isset($post['inscricao_estadual'])) ? $post['inscricao_estadual'] : $this->inscricao_estadual;
    }
    
}
