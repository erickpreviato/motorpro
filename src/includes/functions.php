<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once MODEL_DIR . '/Endereco.php';
include_once MODEL_DIR . '/Pais.php';
include_once MODEL_DIR . '/Estado.php';
include_once MODEL_DIR . '/Cidade.php';

function verifica(){
    return true;
}

function verificaPermissao($perfil = null) {
    return true;
}

function gerarAuditoria($nivel, $msg) {
//    $auditoria = new Auditoria();
//    $auditoria->setdata(date('Y-m-d H:i:s'));
//    $auditoria->setip($_SERVER['REMOTE_ADDR']);
//    $auditoria->setnivel($nivel);
//    $auditoria->setmensagem($msg);
//    $auditoria->insert();
    return true;
}

function removeAcentos($str) {

// assume $str esteja em UTF-8
    $map = array(
        'á' => 'a',
        'à' => 'a',
        'ã' => 'a',
        'â' => 'a',
        'é' => 'e',
        'ê' => 'e',
        'í' => 'i',
        'ó' => 'o',
        'ô' => 'o',
        'õ' => 'o',
        'ú' => 'u',
        'ü' => 'u',
        'ç' => 'c',
        'Á' => 'A',
        'À' => 'A',
        'Ã' => 'A',
        'Â' => 'A',
        'É' => 'E',
        'Ê' => 'E',
        'Í' => 'I',
        'Ó' => 'O',
        'Ô' => 'O',
        'Õ' => 'O',
        'Ú' => 'U',
        'Ü' => 'U',
        'Ç' => 'C'
    );

    return strtr($str, $map); // funciona corretamente
}

