<?php
/**
 * Table Definition for funcionario
 */
require_once 'DB/DataObject.php';

class Funcionario extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'funcionario';         // table name
    public $id;                             // int(4) primary_key not_null
    public $oficina_id;                     // int(4) not_null
    public $nome;                           // varchar(100) not_null
    public $data_exclusao;                  // datetime

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

    public function get_options($ID = null) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/funcionario");
        $pagina = 'option.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('HOME', HOME);

        $funcionario = new Funcionario();
        $funcionario->find();

        while ($funcionario->fetch()) {

            $tpl->setVariable('ID', $funcionario->id);
            $tpl->setVariable('NOME', 'funcionario');
            $tpl->setVariable('VALOR', $funcionario->nome);
            $tpl->setVariable('SELECTED', $funcionario->id == $ID ? 'selected="selected"' : '');

            $tpl->parse('option');
        }

        return $tpl->get();
    }

    public function showAll() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/funcionario");
        $pagina = 'list.tpl.html';
        $tpl->loadTemplateFile($pagina);
        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);

        $tpl->setVariable('HOME', HOME);

        $i = 0;

        while ($this->fetch()) {

            $tpl->setVariable('ID', $this->id);
            $tpl->setVariable('NOME', $this->nome);

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
            $tpl->setVariable("NONE", "Nenhum funcionário cadastrado no momento.");
            $tpl->touchBlock("row_none");
            $tpl->hideBlock("datatable");
        } else {
            $tpl->setVariable('Classe', 'listagem');
            $tpl->touchBlock("datatable");
        }

        return $tpl->get();
    }

    public function showForm() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/funcionario");
        $pagina = 'form.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('HOME', HOME);
        $tpl->setVariable('ID', $this->id);

        $tpl->setVariable('NOME', $this->nome);
        $tpl->setVariable('OFICINA', Oficina::get_oficina(1, 'nome')); // TROCAR: 1 pelo id da oficina

        $botao = (empty($this->id)) ? 'cadastrar' : 'editar';
        $tpl->setVariable('BOTAO', $botao);

        return $tpl->get();
    }

    public function showDetails() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/funcionario");
        $pagina = 'details.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        $tpl->setVariable('NOME', $this->nome);

        return $tpl->get();
    }

    
    public function setDados($post) {
        $this->nome = (isset($post['nome'])) ? $post['nome'] : $this->nome;
    }   

}


