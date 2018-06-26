<?php

/**
 * Table Definition for cidade
 */
require_once 'DB/DataObject.php';

class Cidade extends DB_DataObject {
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'cidade';              // table name
    public $id;                             // int(4) primary_key not_null
    public $nome;                           // varchar(150) not_null
    public $ddd;                            // varchar(4)
    public $estado_id;                      // int(4) not_null
    public $situacao;                       // char(1)

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    public static function get_cidade($ID = null, $campo = null) {

        $cidade = new Cidade();
        $cidade->get($ID);

        return $cidade->$campo;
    }

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

    public static function get_options($ID = null, $estado = null) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/estado");
        $pagina = 'option.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('HOME', HOME);

        $cidade = new Cidade();
        $cidade->setsituacao('A');

        if ($estado) {
            $cidade->setestado_id($estado);
        }

        $cidade->find();

        while ($cidade->fetch()) {

            $tpl->setVariable('ID', $cidade->id);
            $tpl->setVariable('NOME', 'cidade');
            $tpl->setVariable('VALOR', $cidade->nome);
            
            if ($ID) {
                $tpl->setVariable('SELECTED', $cidade->id == $ID ? 'selected="selected"' : '');
            }
            
            $tpl->parse('option');
        }

        return $tpl->get();
    }

    public function showAll() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/cidade");
        $pagina = 'list.tpl.html';
        $tpl->loadTemplateFile($pagina);
        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);

        $tpl->setVariable('HOME', HOME);

        $i = 0;

        while ($this->fetch()) {

            $tpl->setVariable('ID', $this->id);
            $tpl->setVariable('DDD', $this->ddd);
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
            $tpl->setVariable("NONE", "Nenhum Estado cadastrado.");
            $tpl->touchBlock("row_none");
            $tpl->hideBlock("datatable");
        } else {
            $tpl->setVariable('Classe', 'listagem');
            $tpl->touchBlock("datatable");
        }

        return $tpl->get();
    }

    public function showForm() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/cidade");
        $pagina = 'form.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('HOME', HOME);
        $tpl->setVariable('ID', $this->id);

        $tpl->setVariable('NOME', $this->nome);
        $tpl->setVariable('DDD', $this->ddd);
        $tpl->setVariable('OPTION', $this->get_options($this->estado_id));
        $tpl->setVariable('SITUACAO_' . $this->situacao, 'selected="selected"');

        $botao = (empty($this->id)) ? 'cadastrar' : 'editar';
        $tpl->setVariable('BOTAO', $botao);

        empty($this->id) ? $tpl->hideBlock("row_situacao") : $tpl->touchBlock("row_situacao");

        return $tpl->get();
    }

    public function showDetails() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/cidade");
        $pagina = 'details.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        $tpl->setVariable('CODIGO', $this->ddd);
        $tpl->setVariable('NOME', $this->nome);

        return $tpl->get();
    }

    public function showConflito() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/cidade");
        $pagina = 'conflito.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        $tpl->setVariable('CODIGO', $this->getcodigo());
        $tpl->setVariable('NOME', $this->getnome());

        $nome_novo = removeAcentos(strtolower(str_replace(" ", "", $this->getnome())));

        $cidade = new Estado();
        $cidade->whereAdd('id < ' . $this->getid() . ' AND situacao = "A"');
        $cidade->find();

        while ($cidade->fetch()) {
            $nome_original = removeAcentos(strtolower(str_replace(" ", "", $cidade->getnome())));

            if (($nome_novo == $nome_original) && ($cidade->getid() != $this->getid())) {
                $tpl->setVariable('NOME_ORIGINAL', $cidade->getnome());
            }
        }

        return $tpl->get();
    }

    public function setDados($post) {
        $this->ddd = (isset($post['ddd'])) ? $post['ddd'] : $this->ddd;
        $this->estado_id = (isset($post['estado'])) ? $post['estado'] : $this->estado_id;
        $this->nome = (isset($post['nome'])) ? $post['nome'] : $this->nome;
        $this->situacao = (isset($post['situacao'])) ? $post['situacao'] : $this->situacao;
    }

    public function checaConflito($objeto) {

        $retorno = false;

        $cidade = new Cidade();
        $cidade->setsituacao("A");
        $cidade->find();

        while ($cidade->fetch()) {

            $ps = removeAcentos(strtolower(str_replace(" ", "", $cidade->getnome())));
            $obj = removeAcentos(strtolower(str_replace(" ", "", $objeto->getnome())));

            if ($objeto->situacao == "P") {
                if ($objeto->estado_id == $cidade->estado_id) {
                    if (($ps == $obj) && ($cidade->getid() != $objeto->getid())) {
                        $retorno = true;
                    }
                }
            }
        }

        return $retorno;
    }

}
