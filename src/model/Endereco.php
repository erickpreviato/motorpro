<?php

/**
 * Table Definition for endereco
 */
require_once 'DB/DataObject.php';

class Endereco extends DB_DataObject {
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'endereco';            // table name
    public $id;                             // int(4) primary_key not_null
    public $tipo;                           // varchar(50)
    public $logradouro;                     // varchar(200) not_null
    public $numero;                         // varchar(15)
    public $bairro;                         // varchar(200)
    public $cep;                            // varchar(45)
    public $cidade_id;                      // int(4) not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    public function showForm($oficina = null) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/endereco");
        $pagina = 'form.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('HOME', HOME);

        $tpl->setVariable('ID', $this->id);
        $tpl->setVariable('OFICINA', $oficina);
        $tpl->setVariable('TIPO_' . $this->tipo, 'selected="selected"');
        $tpl->setVariable('LOGRADOURO', $this->logradouro);
        $tpl->setVariable('NUMERO', $this->numero);
        $tpl->setVariable('BAIRRO', $this->bairro);
        $tpl->setVariable('CEP', $this->cep);
        $tpl->setVariable('OPTION_CIDADE', Cidade::get_options($this->cidade_id));       
        $idEstado = Cidade::get_cidade($this->cidade_id, 'estado_id');
        $tpl->setVariable('OPTION_ESTADO', Estado::get_options($idEstado));
        $tpl->setVariable('OPTION_PAIS', Pais::get_options(Estado::get_estado($idEstado, 'pais_id')));

        $botao = (empty($this->id)) ? 'cadastrar' : 'editar';
        $tpl->setVariable('BOTAO', $botao);

        return $tpl->get();
    }

    public static function salva($post) {

        $endereco = new Endereco();

        foreach ($post as $key => $val) {

            $campo = $val['name'];
            $valor = $val['value'];
            $endereco->$campo = $valor;
        }

        return $endereco->insert();
    }

}
