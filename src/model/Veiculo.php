<?php
/**
 * Table Definition for veiculo
 */
require_once 'DB/DataObject.php';

class Veiculo extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'veiculo';             // table name
    public $id;                             // int(4) primary_key not_null
    public $tipo_veiculo_id;                // int(4) not_null
    public $placa;                          // varchar(8)
    public $km;                             // int(4)
    public $cor;                            // varchar(45)

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    
    public static function get_options($ID = null) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/veiculo");
        $pagina = 'option.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('HOME', HOME);

        $veiculo = new Veiculo();
        $veiculo->find();

        while ($veiculo->fetch()) {

            $tpl->setVariable('ID', $veiculo->id);
            $tpl->setVariable('NOME', 'pais');
            $tpl->setVariable('VALOR', $veiculo->placa);
            $tpl->setVariable('SELECTED', $veiculo->id == $ID ? 'selected="selected"' : '');

            $tpl->parse('option');
        }

        return $tpl->get();
    }

    public function showAll() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/veiculo");
        $pagina = 'list.tpl.html';
        $tpl->loadTemplateFile($pagina);
        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);

        $tpl->setVariable('HOME', HOME);

        $i = 0;

        while ($this->fetch()) {

            $tpl->setVariable('ID', $this->id);
            $tpl->setVariable('TIPO', Tipo_veiculo::get_campo($this->tipo_veiculo_id, null));
            $tpl->setVariable('PLACA', $this->placa);
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
            $tpl->setVariable("NONE", "Nenhum veículo cadastrado.");
            $tpl->touchBlock("row_none");
            $tpl->hideBlock("datatable");
        } else {
            $tpl->setVariable('Classe', 'listagem');
            $tpl->touchBlock("datatable");
        }

        return $tpl->get();
    }

    public function showForm() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/veiculo");
        $pagina = 'form.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('HOME', HOME);
        $tpl->setVariable('ID', $this->id);
        $tpl->setVariable('NOME', $this->placa);
        $tpl->setVariable('OPTION', Tipo_veiculo::get_options($this->tipo_veiculo_id));
        //$tpl->setVariable('SITUACAO_'.$this->situacao, 'selected="selected"');

        $botao = (empty($this->id)) ? 'cadastrar' : 'editar';
        $tpl->setVariable('BOTAO', $botao);
        
        empty($this->id) ? $tpl->hideBlock("row_situacao") : $tpl->touchBlock("row_situacao");

        return $tpl->get();
    }

    public function showDetails() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/veiculo");
        $pagina = 'details.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        $tpl->setVariable('CODIGO', $this->id);
        $tpl->setVariable('NOME', $this->placa);

        return $tpl->get();
    }

    public function showConflito() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/veiculo");
        $pagina = 'conflito.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        $tpl->setVariable('PLACA', $this->placa());
        //$tpl->setVariable('NOME', $this->getnome());

        $nome_novo = removeAcentos(strtolower(str_replace(" ", "", $this->getnome())));

        $veiculo = new Veiculo();
        $veiculo->whereAdd('id < ' . $this->getid() . ' AND situacao = "A"');
        $veiculo->find();

        while ($veiculo->fetch()) {
            $nome_original = removeAcentos(strtolower(str_replace(" ", "", $veiculo->getnome())));

            if (($nome_novo == $nome_original) && ($veiculo->getid() != $this->getid())) {
                $tpl->setVariable('NOME_ORIGINAL', $veiculo->getplaca());
            }
        }

        return $tpl->get();
    }
    
    public function setDados($post) {
        $this->tipo_veiculo_id = (isset($post['tipo_veiculo_id'])) ? $post['tipo_veiculo_id'] : $this->tipo_veiculo_id;
        $this->placa = (isset($post['placa'])) ? $post['placa'] : $this->placa;
        $this->km = (isset($post['km'])) ? $post['km'] : $this->km;
        $this->cor = (isset($post['cor'])) ? $post['cor'] : $this->cor;
    }

//    public function checaConflito($objeto) {
//
//        $retorno = false;
//
//        $veiculo = new Veiculo();
//        $veiculo->setsituacao("A");
//        $veiculo->find();
//
//        while ($veiculo->fetch()) {
//
//            $ps = removeAcentos(strtolower(str_replace(" ", "", $veiculo->getplaca())));
//            $obj = removeAcentos(strtolower(str_replace(" ", "", $objeto->getplaca())));
//
//            if ($objeto->situacao == "P") {
//                if (($ps == $obj) && ($veiculo->getid() != $objeto->getid())) {
//                    $retorno = true;
//                }
//            }
//        }
//
//        return $retorno;
//    }
}
