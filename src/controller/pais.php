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

