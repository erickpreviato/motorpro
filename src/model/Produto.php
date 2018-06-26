<?php

/**
 * Table Definition for produto
 */
require_once 'DB/DataObject.php';

class Produto extends DB_DataObject {
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

    public static function get_produto($ID = null, $campo = null) {

        return false;

        if ($ID) {
            $produto = new Produto();
            $produto->get($ID);

            return $produto->$campo;
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

    public static function get_options($ID = null, $produto = null) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/produto");
        $pagina = 'option.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('HOME', HOME);

        $produto = new Produto();
        $produto->find();

        while ($produto->fetch()) {

            $tpl->setVariable('ID', $produto->id);
            $tpl->setVariable('NOME', 'produto');
            $tpl->setVariable('VALOR', $produto->descricao);

            if ($ID) {
                $tpl->setVariable('SELECTED', $produto->id == $ID ? 'selected="selected"' : '');
            }

            $tpl->parse('option');
        }

        return $tpl->get();
    }

    public function showAll() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/produto");
        $pagina = 'list.tpl.html';
        $tpl->loadTemplateFile($pagina);
        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);

        $tpl->setVariable('HOME', HOME);

        $i = 0;

        while ($this->fetch()) {

            $tpl->setVariable('ID', $this->id);
            $tpl->setVariable('DDD', $this->descricao);
            //$tpl->setVariable('NOME', $this->nome);
            //$tpl->setVariable('SITUACAO', $this->get_situacao($this->situacao));

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

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/produto");
        $pagina = 'form.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('HOME', HOME);
        $tpl->setVariable('ID', $this->id);

        $tpl->setVariable('NOME', $this->descricao);
        //$tpl->setVariable('DDD', $this->ddd);
        //$tpl->setVariable('OPTION', $this->get_options($this->estado_id));
        //$tpl->setVariable('SITUACAO_' . $this->situacao, 'selected="selected"');

        $botao = (empty($this->id)) ? 'cadastrar' : 'editar';
        $tpl->setVariable('BOTAO', $botao);

        empty($this->id) ? $tpl->hideBlock("row_situacao") : $tpl->touchBlock("row_situacao");

        return $tpl->get();
    }

    public function showDetails() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/produto");
        $pagina = 'details.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        $tpl->setVariable('CODIGO', $this->id);
        $tpl->setVariable('NOME', $this->descricao);

        return $tpl->get();
    }

    public function showConflito() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/produto");
        $pagina = 'conflito.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        $tpl->setVariable('CODIGO', $this->getid());
        $tpl->setVariable('NOME', $this->getdescricao());

        $nome_novo = removeAcentos(strtolower(str_replace(" ", "", $this->getdescricao())));

        $produto = new Produto();
        $produto->whereAdd('id < ' . $this->getid() . ' AND situacao = "A"');
        $produto->find();

        while ($produto->fetch()) {
            $nome_original = removeAcentos(strtolower(str_replace(" ", "", $produto->getdescricao())));

            if (($nome_novo == $nome_original) && ($produto->getid() != $this->getid())) {
                $tpl->setVariable('NOME_ORIGINAL', $produto->getdescricao());
            }
        }

        return $tpl->get();
    }

    public function setDados($post) {
        $this->descricao = (isset($post['descricao'])) ? $post['descricao'] : $this->descricao;
        $this->estoque_minimo = (isset($post['estoque_minimo'])) ? $post['estoque_minimo'] : $this->estoque_minimo;
        $this->produto_marca_id = (isset($post['produto_marca_id'])) ? $post['produto_marca_id'] : $this->produto_marca_id;
        $this->quantidade = (isset($post['quantidade'])) ? $post['quantidade'] : $this->quantidade;
        $this->valor = (isset($post['valor'])) ? $post['valor'] : $this->valor;
        $this->valor_venda = (isset($post['valor_venda'])) ? $post['valor_venda'] : $this->valor_venda;
    }

    public function checaConflito($objeto) {

        $retorno = false;

        $produto = new Produto();
        //$produto->setsituacao("A");
        $produto->find();

        while ($produto->fetch()) {

            $ps = removeAcentos(strtolower(str_replace(" ", "", $produto->getnome())));
            $obj = removeAcentos(strtolower(str_replace(" ", "", $objeto->getnome())));

            if ($objeto->situacao == "P") {
                //if ($objeto->estado_id == $produto->estado_id) {
                    if (($ps == $obj) && ($produto->getid() != $objeto->getid())) {
                        $retorno = true;
                    }
               // }
            }
        }

        return $retorno;
    }

}
