<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (isset($_POST['showForm'])) {
    
    $pais = new Pais();
    if ($_POST['showForm'] > 0)
        $pais->get($_POST['showForm']);
    echo $pais->showForm();
    die();
}

if (isset($_POST['showDetails'])) {

    $pais = new Pais();
    $pais->get($_POST['showDetails']);
    echo $pais->showDetails();
    die();

}

if (isset($_POST['showConflito'])) {

    $pais = new Pais();
    $pais->get($_POST['showConflito']);
    echo $pais->showConflito();
    die();

}


if (isset($_POST['cadastrar'])) {
    $pais = new Pais();
    $pais->setDados($_POST);
    $pais->setsituacao('P');

    if ($id = $pais->insert()) {
        $_SESSION['msg'] = 'País cadastrado com succeso!';
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
    $pais = new Pais();
    $pais->get($_POST['id']);
    $pais->setDados($_POST);

    if ($pais->update()) {
        $_SESSION['msg'] = 'País alterado com succeso!';
        $_SESSION['t'] = 'success';

        gerarAuditoria('INFORMACAO', 'Usuario '.$_SESSION['usuario'].' editou o país com id ('.$pais->getid().') ');
    } else {
        $_SESSION['msg'] = 'Erro ao editar país. Tente novamente mais tarde. <br />Caso o problema persista entre em contato.';
        $_SESSION['t'] = 'error';

        gerarAuditoria('ERRO', 'Usuario '.$_SESSION['usuario'].' tentou editar o país com id ('.$pais->getid().') ');
    }

    header("Location: .");
    die();
}

if (isset($_POST['verifica'])) {
    
    $retorno = 'false';
    
    $novo = removeAcentos(strtolower(str_replace(" ", "", $_POST['verifica'])));
    
    $pais = new Pais();
    $pais->find();
    
    while ($pais->fetch()) {
       
        $existente = removeAcentos(strtolower(str_replace(" ", "", $pais->nome)));
        
        if (($novo == $existente) && ($_POST['ID'] != $pais->id)) {
            $retorno = 'true';
        }
        
    }
    
    echo $retorno;
    die();
}



