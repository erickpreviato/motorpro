<?php

/**
 * Table Definition for estado
 */
require_once 'DB/DataObject.php';

class Estado extends DB_DataObject {
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'estado';              // table name
    public $id;                             // int(4) primary_key not_null
    public $nome;                           // varchar(150) not_null
    public $sigla;                          // varchar(2) not_null
    public $pais_id;                        // int(4) not_null
    public $situacao;                       // char(1)

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    public static function get_estado($ID = null, $campo = null) {

        return false;

        if ($ID) {
            $estado = new Estado();
            $estado->get($ID);

            return $estado->$campo;
        }
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

    public static function get_options($ID = null, $pais = null) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/estado");
        $pagina = 'option.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('HOME', HOME);

        $estado = new Estado();
        $estado->setsituacao('A');

        if ($pais) {
            $estado->setpais_id($pais);
        }

        $estado->find();

        while ($estado->fetch()) {

            $tpl->setVariable('ID', $estado->id);
            $tpl->setVariable('NOME', 'estado');
            $tpl->setVariable('VALOR', $estado->nome);
            $tpl->setVariable('SELECTED', $estado->id == $ID ? 'selected="selected"' : '');

            $tpl->parse('option');
        }

        return $tpl->get();
    }

    public function showAll() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/estado");
        $pagina = 'list.tpl.html';
        $tpl->loadTemplateFile($pagina);
        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);

        $tpl->setVariable('HOME', HOME);

        $i = 0;

        while ($this->fetch()) {

            $tpl->setVariable('ID', $this->id);
            $tpl->setVariable('SIGLA', $this->sigla);
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

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/estado");
        $pagina = 'form.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('HOME', HOME);
        $tpl->setVariable('ID', $this->id);

        $tpl->setVariable('NOME', $this->nome);
        $tpl->setVariable('SIGLA', $this->sigla);
        $tpl->setVariable('OPTION', Pais::get_options($this->pais_id));
        $tpl->setVariable('SITUACAO_' . $this->situacao, 'selected="selected"');

        $botao = (empty($this->id)) ? 'cadastrar' : 'editar';
        $tpl->setVariable('BOTAO', $botao);

        empty($this->id) ? $tpl->hideBlock("row_situacao") : $tpl->touchBlock("row_situacao");

        return $tpl->get();
    }

    public function showDetails() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/estado");
        $pagina = 'details.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        $tpl->setVariable('CODIGO', $this->sigla);
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

        $estado = new Estado();
        $estado->whereAdd('id < ' . $this->getid() . ' AND situacao = "A"');
        $estado->find();

        while ($estado->fetch()) {
            $nome_original = removeAcentos(strtolower(str_replace(" ", "", $estado->getnome())));

            if (($nome_novo == $nome_original) && ($estado->getid() != $this->getid())) {
                $tpl->setVariable('NOME_ORIGINAL', $estado->getnome());
            }
        }

        return $tpl->get();
    }

    public function setDados($post) {
        $this->sigla = (isset($post['sigla'])) ? $post['sigla'] : $this->sigla;
        $this->pais_id = (isset($post['pais'])) ? $post['pais'] : $this->pais_id;
        $this->nome = (isset($post['nome'])) ? $post['nome'] : $this->nome;
        $this->situacao = (isset($post['situacao'])) ? $post['situacao'] : $this->situacao;
    }

    public function checaConflito($objeto) {

        $retorno = false;

        $estado = new Estado();
        $estado->setsituacao("A");
        $estado->find();

        while ($estado->fetch()) {

            $ps = removeAcentos(strtolower(str_replace(" ", "", $estado->getnome())));
            $obj = removeAcentos(strtolower(str_replace(" ", "", $objeto->getnome())));

            if ($objeto->situacao == "P") {
                if ($objeto->pais_id == $estado->pais_id) {
                    if (($ps == $obj) && ($estado->getid() != $objeto->getid())) {
                        $retorno = true;
                    }
                }
            }
        }

        return $retorno;
    }

}
