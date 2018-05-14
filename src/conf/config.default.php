<?php

/*
  Copyright © 2018 EC.on Sistemas <econ@econ.usp.br>

  Este arquivo é parte do programa "Motor Pro"

  Vagas é um software livre; você pode redistribuí-lo e/ou
  modificá-lo dentro dos termos da Licença Pública Geral GNU como
  publicada pela Fundação do Software Livre (FSF); na versão 3 da
  Licença, ou (a seu critério) qualquer versão posterior.

  Este programa é distribuído na esperança de que possa ser  útil,
  mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÃO
  a qualquer MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
  Licença Pública Geral GNU para maiores detalhes.

  Você deve ter recebido uma cópia da Licença Pública Geral GNU junto
  com este programa, Se não, veja <http://www.gnu.org/licenses/>.
 */
?>
<?php

/*
 *  <p>
 *  Configurações gerais do sistema
 *  </p>
 * 
 *  <p>
 *  <strong>Histórico de versões</strong>
 *  <ul>
 *      <li>Criação da classe 12/2016</li>
 *  </ul>
 *  </p>
 *  
 *  @author Carlos Eduardo Favaro <cadufavaro@gmail.com>
 *  @copyright EC.on Sistemas
 */

session_start();

//################################################ EDITAR O DIRETÓRIO ########
define('DIR', "D:/ECon/motorpro/src");
define('CONF', "D:/ECon/motorpro/conf/");
define('MODEL_DIR', DIR . "/model");
define('VIEW_DIR', DIR . "/view");
define('CONTROLLER_DIR', DIR . "/controller");
define('INCLUDE_DIR', DIR . "/includes");
define('LIBRARY_DIR', DIR . "/library");
define('FILES_DIR', DIR . "/files");

define('SITE_KEY_RECAPTCHA', '6LeiCzIUAAAAABFNoZenCVegUG3OF8ql-Ef1Sv7s');
define('SECRET_KEY_RECAPTCHA', '6LeiCzIUAAAAAEFptnyx4Y3dq2ildJeQN6GeQnLs');

################################################ EDITAR A URL ##############
define('URL', "http://143.107.231.227:8080/motorpro");
define('HOME', URL);
define('IMAGE_URL', URL . "/view/img");
define('CSS_URL', URL . "/view/css");
define('JS_URL', URL . "/view/js");

define('EMAILBCC', 'cadufavaro@gmail.com');
define('BCC', 'WebMaster');


$PHP_SELF = $_SERVER['PHP_SELF'];

//Usando PEAR local
//ini_set('include_path', DIR.'/pear');
//require_once DIR . '/pear/DB/DataObject.php';
//require_once DIR . '/pear/Template/Sigma.php';
//Usando PEAR do sistema
require_once 'DB/DataObject.php';
require_once 'HTML/Template/Sigma.php';

include_once INCLUDE_DIR . '/functions.php';

include_once LIBRARY_DIR . '/PHPMailer/class.phpmailer.php';


$options = &PEAR::getStaticProperty('DB_DataObject', 'options');
$config = parse_ini_file('D:/ECon/motorpro/conf/motorprobd.ini', TRUE);
$options = $config['DB_DataObject'];


define('LANG', "pt-br");
date_default_timezone_set("Brazil/East");

header("Cache-Control: no-cache");

//session_cache_limiter('private');
//session_cache_expire(1);

//Desativar o Debug do PEAR 0-desativa e 1 seguintes aumenta ou diminui as informações do DEBUG
DB_DataObject::debugLevel(0);

ini_set("display_errors", 1);
error_reporting(E_ALL);
?>
