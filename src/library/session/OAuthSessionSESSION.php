<?php
/*
Copyright © 2018 EC.on Sistemas <econ@econ.com.br>

Este arquivo é parte do programa "MotorPro"

MotorPro é um software livre; você pode redistribuí-lo e/ou 
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

/**
 * Abstract base class for OAuthStore implementations
 * 
 * @version $Id$
 * @author Bruno Barberi Gnecco <brunobg@corollarium.com>
 * 
 * The MIT License
 * 
 * Copyright (c) 2010 Corollarium Technologies
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

require_once dirname(__FILE__) . '/OAuthSessionAbstract.class.php';

class OAuthSessionSESSION extends OAuthSessionAbstract
{
	public function __construct( $options = array() )
	{
	}

	/**
	 * Gets a variable value
	 * 
	 * @param string $key
	 * @return The value or null if not set.
	 */
	public function get ( $key ) 
	{
		return @$_SESSION[$key];
	}
	
	/**
	 * Sets a variable value
	 * 
	 * @param string $key The key
	 * @param any $data The data 
	 */
	public function set ( $key, $data ) 
	{
		$_SESSION[$key] = $data;
	}
}

?>