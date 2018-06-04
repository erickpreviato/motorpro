<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (isset($_POST['showForm'])) {
    
    $veiculo = new Veiculo();
    if ($_POST['showForm'] > 0)
        $veiculo->get($_POST['showForm']);
    echo $veiculo->showForm();
    die();
}

if (isset($_POST['showDetails'])) {

    $veiculo = new Veiculo();
    $veiculo->get($_POST['showDetails']);
    echo $veiculo->showDetails();
    die();

}

if (isset($_POST['showConflito'])) {

    $veiculo = new Veiculo();
    $veiculo->get($_POST['showConflito']);
    echo $veiculo->showConflito();
    die();

}


if (isset($_POST['cadastrar'])) {
    $veiculo = new Veiculo();
    $veiculo->setDados($_POST);

    if ($id = $veiculo->insert()) {
        $_SESSION['msg'] = 'Veículo cadastrado com succeso!';
        $_SESSION['t'] = 'success';

        gerarAuditoria('INFORMACAO', 'Usuario ' . $_SESSION['usuario'] . ' cadastrou novo veículo com id (' . $id . ') ');
    } else {
        $_SESSION['msg'] = 'Erro ao tentar cadastrar. Tente novamente mais tarde. <br />Caso o problema persista entre em contato.';
        $_SESSION['t'] = 'error';

        gerarAuditoria('ERRO', 'Usuario ' . $_SESSION['usuario'] . ' tentou cadastrar novo veículo');
    }
    header("Location: .");
    die();
}

if (isset($_POST['editar'])) {
    $veiculo = new Veiculo();
    $veiculo->get($_POST['id']);
    $veiculo->setDados($_POST);

    if ($veiculo->update()) {
        $_SESSION['msg'] = 'Veículo alterado com succeso!';
        $_SESSION['t'] = 'success';

        gerarAuditoria('INFORMACAO', 'Usuario '.$_SESSION['usuario'].' editou o veículo com id ('.$pais->getid().') ');
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
    
    $veiculo = new Veiculo();
    $veiculo->find();
    
    while ($veiculo->fetch()) {
       
        $existente = removeAcentos(strtolower(str_replace(" ", "", $veiculo->placa)));
        
        if (($novo == $existente) && ($_POST['ID'] != $veiculo->id)) {
            $retorno = 'true';
        }
        
    }
    
    echo $retorno;
    die();
}




