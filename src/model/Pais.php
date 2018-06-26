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
    public $situacao;                       // char(1)

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    public static function get_situacao($situacao) {

        switch ($situacao) {

            case 'A':
                return '<span class="label label-success">Ativo</span>';
                break;
            case 'P':
                return '<span class="label label-warning">Pendente</span>';
                break;
        }
    }

    public static function get_options($ID = null) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/pais");
        $pagina = 'option.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('HOME', HOME);

        $pais = new Pais();
        $pais->setsituacao('A');
        $pais->find();

        while ($pais->fetch()) {

            $tpl->setVariable('ID', $pais->id);
            $tpl->setVariable('NOME', 'pais');
            $tpl->setVariable('VALOR', $pais->nome);
            if ($ID) {
                $tpl->setVariable('SELECTED', $pais->id == $ID ? 'selected="selected"' : '');
            }

            $tpl->parse('option');
        }

        return $tpl->get();
    }

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
            $tpl->setVariable('SITUACAO', $this->get_situacao($this->situacao));

            if ($this->checaConflito($this)) {
                $acao = '<button data-toggle="tooltip" title="Corrigir conflito" value="' . $this->id . '" class="btn btn-xs btn-warning btn-conflito"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span></button>';
            } else {
                $acao = '<button data-toggle="tooltip" title="Editar" value="' . $this->id . '" class="btn btn-xs btn-default btn-form"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
            }
            $acao .= '<button data-toggle="tooltip" title="Ver mais detalhes" value="' . $this->id . '" class="btn btn-xs btn-default btn-details"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button> ';
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
        $tpl->setVariable('SITUACAO_' . $this->situacao, 'selected="selected"');

        $botao = (empty($this->id)) ? 'cadastrar' : 'editar';
        $tpl->setVariable('BOTAO', $botao);

        empty($this->id) ? $tpl->hideBlock("row_situacao") : $tpl->touchBlock("row_situacao");

        return $tpl->get();
    }

    public function showDetails() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/pais");
        $pagina = 'details.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        $tpl->setVariable('CODIGO', $this->codigo);
        $tpl->setVariable('NOME', $this->nome);

        return $tpl->get();
    }

    public function showConflito() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/pais");
        $pagina = 'conflito.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        $tpl->setVariable('CODIGO', $this->getcodigo());
        $tpl->setVariable('NOME', $this->getnome());

        $nome_novo = removeAcentos(strtolower(str_replace(" ", "", $this->getnome())));

        $pais = new Pais();
        $pais->whereAdd('id < ' . $this->getid() . ' AND situacao = "A"');
        $pais->find();

        while ($pais->fetch()) {
            $nome_original = removeAcentos(strtolower(str_replace(" ", "", $pais->getnome())));

            if (($nome_novo == $nome_original) && ($pais->getid() != $this->getid())) {
                $tpl->setVariable('NOME_ORIGINAL', $pais->getnome());
            }
        }

        return $tpl->get();
    }

    public function setDados($post) {
        $this->codigo = (isset($post['codigo'])) ? $post['codigo'] : $this->codigo;
        $this->nome = (isset($post['nome'])) ? $post['nome'] : $this->nome;
        $this->situacao = (isset($post['situacao'])) ? $post['situacao'] : $this->situacao;
    }

    public function checaConflito($objeto) {

        $retorno = false;

        $pais = new Pais();
        $pais->setsituacao("A");
        $pais->find();

        while ($pais->fetch()) {

            $ps = removeAcentos(strtolower(str_replace(" ", "", $pais->getnome())));
            $obj = removeAcentos(strtolower(str_replace(" ", "", $objeto->getnome())));

            if ($objeto->situacao == "P") {
                if (($ps == $obj) && ($pais->getid() != $objeto->getid())) {
                    $retorno = true;
                }
            }
        }

        return $retorno;
    }

}
