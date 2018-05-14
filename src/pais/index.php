<?php

/*
 * 
 * Copyright © 2018 EC.on Sistemas <econ@econ.usp.br>
 * 
 * Este arquivo é parte do programa "EC.on Sistemas"
 * 
 * Sistema MotorPro é um software livre; você pode redistribuí-lo e/ou 
 * modificá-lo dentro dos termos da Licença Pública Geral GNU como 
 * publicada pela Fundação do Software Livre (FSF); na versão 3 da 
 * Licença, ou (a seu critério) qualquer versão posterior.
 * 
 * Este programa é distribuído na esperança de que possa ser  útil, 
 * mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÃO
 * a qualquer MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
 * Licença Pública Geral GNU para maiores detalhes.
 * 
 * Você deve ter recebido uma cópia da Licença Pública Geral GNU junto
 * com este programa, Se não, veja <http://www.gnu.org/licenses/>.
 * 
 */
/**
 * <p> 
 * Arquivo de controle dos paises
 * </p> 
 *  
 * <p> 
 * <strong>Histórico de Versões</strong>
 * <ul> 
 *   <li>#desenvolvimento - Criação do arquivo</li>
 * </ul> 
 * </p> 
 *  
 * @author Carlos Eduardo Favaro <cadufavaro@econ.usp.br>
 * @copyright EC.on Sistemas
 */
include_once '../conf/config.default.php';
verifica();

include_once MODEL_DIR . '/Pais.php';
include_once CONTROLLER_DIR . '/pais.php';

$pais = new Pais();

include_once INCLUDE_DIR . '/header.php';

if (verificaPermissao('Administrador')) {
    $pais->find();
    echo $pais->showAll();
} else {
    //echo permissaoNegada();
}

include_once INCLUDE_DIR . '/footer.php';

