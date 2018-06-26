<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (isset($_POST['showForm'])) {
    
    $produto = new Produto();
    if ($_POST['showForm'] > 0)
        $produto->get($_POST['showForm']);
    echo $produto->showForm();
    die();
}

if (isset($_POST['showDetails'])) {

    $produto = new Produto();
    $produto->get($_POST['showDetails']);
    echo $produto->showDetails();
    die();

}

if (isset($_POST['showConflito'])) {

    $produto = new Produto();
    $produto->get($_POST['showConflito']);
    echo $produto->showConflito();
    die();

}


if (isset($_POST['cadastrar'])) {
    $produto = new Produto();
    $produto->setDados($_POST);
    $produto->setsituacao('P');

    if ($id = $produto->insert()) {
        $_SESSION['msg'] = 'Cidade cadastrado com succeso!';
        $_SESSION['t'] = 'success';

        gerarAuditoria('INFORMACAO', 'Usuario ' . $_SESSION['usuario'] . ' cadastrou novo produto com id (' . $id . ') ');
    } else {
        $_SESSION['msg'] = 'Erro ao tentar cadastrar. Tente novamente mais tarde. <br />Caso o problema persista entre em contato.';
        $_SESSION['t'] = 'error';

        gerarAuditoria('ERRO', 'Usuario ' . $_SESSION['usuario'] . ' tentou cadastrar novo produto');
    }
    header("Location: .");
    die();
}

if (isset($_POST['editar'])) {
    $produto = new Produto();
    $produto->get($_POST['id']);
    $produto->setDados($_POST);

    if ($produto->update()) {
        $_SESSION['msg'] = 'Cidade alterado com succeso!';
        $_SESSION['t'] = 'success';

        gerarAuditoria('INFORMACAO', 'Usuario '.$_SESSION['usuario'].' editou o produto com id ('.$produto->getid().') ');
    } else {
        $_SESSION['msg'] = 'Erro ao editar produto. Tente novamente mais tarde. <br />Caso o problema persista entre em contato.';
        $_SESSION['t'] = 'error';

        gerarAuditoria('ERRO', 'Usuario '.$_SESSION['usuario'].' tentou editar o produto com id ('.$produto->getid().') ');
    }

    header("Location: .");
    die();
}

if (isset($_POST['verifica'])) {
    
    $retorno = 'false';
    
    $novo = removeAcentos(strtolower(str_replace(" ", "", $_POST['verifica'])));
    
    $produto = new Produto();
    $produto->find();
    
    while ($produto->fetch()) {
       
        $existente = removeAcentos(strtolower(str_replace(" ", "", $produto->descricao)));
        
        if (($novo == $existente) && ($_POST['produto'] == $produto->id)) {
            $retorno = 'true';
        }
        
    }
    
    echo $retorno;
    die();
}

if (isset($_POST['filtraProduto'])) {

    $produto = new Produto();
    echo ($produto->get_options(null, $_POST['filtraProduto']));
    die();
}



