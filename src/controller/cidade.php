<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (isset($_POST['showForm'])) {
    
    $cidade = new Cidade();
    if ($_POST['showForm'] > 0)
        $cidade->get($_POST['showForm']);
    echo $cidade->showForm();
    die();
}

if (isset($_POST['showDetails'])) {

    $cidade = new Cidade();
    $cidade->get($_POST['showDetails']);
    echo $cidade->showDetails();
    die();

}

if (isset($_POST['showConflito'])) {

    $cidade = new Cidade();
    $cidade->get($_POST['showConflito']);
    echo $cidade->showConflito();
    die();

}


if (isset($_POST['cadastrar'])) {
    $cidade = new Cidade();
    $cidade->setDados($_POST);
    $cidade->setsituacao('P');

    if ($id = $cidade->insert()) {
        $_SESSION['msg'] = 'Cidade cadastrado com succeso!';
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
    $cidade = new Cidade();
    $cidade->get($_POST['id']);
    $cidade->setDados($_POST);

    if ($cidade->update()) {
        $_SESSION['msg'] = 'Cidade alterado com succeso!';
        $_SESSION['t'] = 'success';

        gerarAuditoria('INFORMACAO', 'Usuario '.$_SESSION['usuario'].' editou o país com id ('.$cidade->getid().') ');
    } else {
        $_SESSION['msg'] = 'Erro ao editar país. Tente novamente mais tarde. <br />Caso o problema persista entre em contato.';
        $_SESSION['t'] = 'error';

        gerarAuditoria('ERRO', 'Usuario '.$_SESSION['usuario'].' tentou editar o país com id ('.$cidade->getid().') ');
    }

    header("Location: .");
    die();
}

if (isset($_POST['verifica'])) {
    
    $retorno = 'false';
    
    $novo = removeAcentos(strtolower(str_replace(" ", "", $_POST['verifica'])));
    
    $cidade = new Cidade();
    $cidade->find();
    
    while ($cidade->fetch()) {
       
        $existente = removeAcentos(strtolower(str_replace(" ", "", $cidade->nome)));
        
        if (($novo == $existente) && ($_POST['estado'] == $cidade->estado_id)) {
            $retorno = 'true';
        }
        
    }
    
    echo $retorno;
    die();
}

if (isset($_POST['filtraCidade'])) {

    $cidade = new Cidade();
    echo ($cidade->get_options(null, $_POST['filtraCidade']));
    die();
}



