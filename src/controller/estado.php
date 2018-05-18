<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (isset($_POST['showForm'])) {
    
    $estado = new Estado();
    if ($_POST['showForm'] > 0)
        $estado->get($_POST['showForm']);
    echo $estado->showForm();
    die();
}

if (isset($_POST['showDetails'])) {

    $estado = new Estado();
    $estado->get($_POST['showDetails']);
    echo $estado->showDetails();
    die();

}

if (isset($_POST['showConflito'])) {

    $estado = new Estado();
    $estado->get($_POST['showConflito']);
    echo $estado->showConflito();
    die();

}


if (isset($_POST['cadastrar'])) {
    $estado = new Estado();
    $estado->setDados($_POST);
    $estado->setsituacao('P');

    if ($id = $estado->insert()) {
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
    $estado = new Estado();
    $estado->get($_POST['id']);
    $estado->setDados($_POST);

    if ($estado->update()) {
        $_SESSION['msg'] = 'País alterado com succeso!';
        $_SESSION['t'] = 'success';

        gerarAuditoria('INFORMACAO', 'Usuario '.$_SESSION['usuario'].' editou o país com id ('.$estado->getid().') ');
    } else {
        $_SESSION['msg'] = 'Erro ao editar país. Tente novamente mais tarde. <br />Caso o problema persista entre em contato.';
        $_SESSION['t'] = 'error';

        gerarAuditoria('ERRO', 'Usuario '.$_SESSION['usuario'].' tentou editar o país com id ('.$estado->getid().') ');
    }

    header("Location: .");
    die();
}

if (isset($_POST['verifica'])) {
    
    $retorno = 'false';
    
    $novo = removeAcentos(strtolower(str_replace(" ", "", $_POST['verifica'])));
    
    $estado = new Estado();
    $estado->find();
    
    while ($estado->fetch()) {
       
        $existente = removeAcentos(strtolower(str_replace(" ", "", $estado->nome)));
        
        if (($novo == $existente) && ($_POST['pais'] == $estado->pais_id)) {
            $retorno = 'true';
        }
        
    }
    
    echo $retorno;
    die();
}

if (isset($_POST['filtraEstado'])) {
    $estado = new Estado();
    echo ($estado->get_options(null, $_POST['filtraEstado']));
    die();
}



