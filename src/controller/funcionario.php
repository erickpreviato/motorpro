<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (isset($_POST['showForm'])) {
    
    $funcionario = new Funcionario();
    if ($_POST['showForm'] > 0)
        $funcionario->get($_POST['showForm']);
    echo $funcionario->showForm();
    die();
}

if (isset($_POST['showDetails'])) {

    $funcionario = new Funcionario();
    $funcionario->get($_POST['showDetails']);
    echo $funcionario->showDetails();
    die();

}

if (isset($_POST['showConflito'])) {

    $funcionario = new Funcionario();
    $funcionario->get($_POST['showConflito']);
    echo $funcionario->showConflito();
    die();

}


if (isset($_POST['cadastrar'])) {
    $funcionario = new Funcionario();
    $funcionario->setDados($_POST);
    $funcionario->setoficina_id(1); // TROCAR: trocar pela oficina logada

    if ($id = $funcionario->insert()) {
        $_SESSION['msg'] = 'Funcionario cadastrado com succeso!';
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
    $funcionario = new Funcionario();
    $funcionario->get($_POST['id']);
    $funcionario->setDados($_POST);

    if ($funcionario->update()) {
        $_SESSION['msg'] = 'Funcionário alterado com succeso!';
        $_SESSION['t'] = 'success';

        gerarAuditoria('INFORMACAO', 'Usuario '.$_SESSION['usuario'].' editou o país com id ('.$funcionario->getid().') ');
    } else {
        $_SESSION['msg'] = 'Erro ao editar país. Tente novamente mais tarde. <br />Caso o problema persista entre em contato.';
        $_SESSION['t'] = 'error';

        gerarAuditoria('ERRO', 'Usuário '.$_SESSION['usuario'].' tentou editar o país com id ('.$funcionario->getid().') ');
    }

    header("Location: .");
    die();
}

if (isset($_POST['verifica'])) {
    
    $retorno = 'false';
    
    $novo = removeAcentos(strtolower(str_replace(" ", "", $_POST['verifica'])));
    
    $funcionario = new Funcionario();
    $funcionario->find();
    
    while ($funcionario->fetch()) {
       
        $existente = removeAcentos(strtolower(str_replace(" ", "", $funcionario->nome)));
        
        if (($novo == $existente) && ($_POST['estado'] == $funcionario->estado_id)) {
            $retorno = 'true';
        }
        
    }
    
    echo $retorno;
    die();
}



