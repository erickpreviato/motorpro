<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (isset($_POST['showForm'])) {

    $oficina = new Oficina();
    if ($_POST['showForm'] > 0)
        $oficina->get($_POST['showForm']);
    echo $oficina->showForm();
    die();
}

if (isset($_POST['showDetails'])) {

    $oficina = new Oficina();
    $oficina->get($_POST['showDetails']);
    echo $oficina->showDetails();
    die();
}

if (isset($_POST['showConflito'])) {

    $oficina = new Oficina();
    $oficina->get($_POST['showConflito']);
    echo $oficina->showConflito();
    die();
}


if (isset($_POST['cadastrar'])) {
    $oficina = new Oficina();
    $oficina->setDados($_POST);

    if ($id = $oficina->insert()) {
        $_SESSION['msg'] = 'Oficina cadastrado com succeso!';
        $_SESSION['t'] = 'success';

        gerarAuditoria('INFORMACAO', 'Usuario ' . $_SESSION['usuario'] . ' cadastrou novo país com id (' . $id . ') ');
    } else {
        $_SESSION['msg'] = 'Erro ao tentar cadastrar. Tente novamente mais tarde. <br />Caso o problema persista entre em contato.';
        $_SESSION['t'] = 'error';

        gerarAuditoria('ERRO', 'Usuario ' . $_SESSION['usuario'] . ' tentou cadastrar novo país');
    }
    header("Location: .");
    die();
}

if (isset($_POST['editar'])) {
    $oficina = new Oficina();
    $oficina->get($_POST['id']);
    $oficina->setDados($_POST);

    if ($oficina->update()) {
        $_SESSION['msg'] = 'País alterado com succeso!';
        $_SESSION['t'] = 'success';

        gerarAuditoria('INFORMACAO', 'Usuario ' . $_SESSION['usuario'] . ' editou o oficina com id (' . $oficina->getid() . ') ');
    } else {
        $_SESSION['msg'] = 'Erro ao editar oficina. Tente novamente mais tarde. <br />Caso o problema persista entre em contato.';
        $_SESSION['t'] = 'error';

        gerarAuditoria('ERRO', 'Usuario ' . $_SESSION['usuario'] . ' tentou editar o país com id (' . $oficina->getid() . ') ');
    }

    header("Location: .");
    die();
}


if (isset($_POST['showFormEndereco'])) {

    $endereco = new Endereco();
    if ($_POST['showFormEndereco'] > 0)
        $endereco->get($_POST['showFormEndereco']);
    echo $endereco->showForm();
    die();
}

if (isset($_POST['salvar_endereco'])) {

    $endereco = Endereco::salva($_POST['dados']);
    $oficina_endereco = Oficina_endereco::salvar($_POST['oficina'], $endereco);
    
    echo ($endereco.' - '.$oficina_endereco);
    
    die();
}



