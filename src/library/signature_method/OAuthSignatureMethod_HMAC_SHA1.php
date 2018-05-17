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
 * OAuth signature implementation using HMAC-SHA1
 * 
 * @version $Id$
 * @author Marc Worrell <marcw@pobox.com>
 * @date  Sep 8, 2008 12:21:19 PM
 * 
 * The MIT License
 * 
 * Copyright (c) 2007-2008 Mediamatic Lab
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


require_once dirname(__FILE__).'/OAuthSignatureMethod.class.php';


class OAuthSignatureMethod_HMAC_SHA1 extends OAuthSignatureMethod
{
	public function name ()
	{
		return 'HMAC-SHA1';
	}


	/**
	 * Calculate the signature using HMAC-SHA1
	 * This function is copyright Andy Smith, 2007.
	 * 
	 * @param OAuthRequest request
	 * @param string base_string
	 * @param string consumer_secret
	 * @param string token_secret
	 * @return string  
	 */
	function signature ( $request, $base_string, $consumer_secret, $token_secret )
	{
		$key = $request->urlencode($consumer_secret).'&'.$request->urlencode($token_secret);
		if (function_exists('hash_hmac'))
		{
			$signature = base64_encode(hash_hmac("sha1", $base_string, $key, true));
		}
		else
		{
		    $blocksize	= 64;
		    $hashfunc	= 'sha1';
		    if (strlen($key) > $blocksize)
		    {
		        $key = pack('H*', $hashfunc($key));
		    }
		    $key	= str_pad($key,$blocksize,chr(0x00));
		    $ipad	= str_repeat(chr(0x36),$blocksize);
		    $opad	= str_repeat(chr(0x5c),$blocksize);
		    $hmac 	= pack(
		                'H*',$hashfunc(
		                    ($key^$opad).pack(
		                        'H*',$hashfunc(
		                            ($key^$ipad).$base_string
		                        )
		                    )
		                )
		            );
			$signature = base64_encode($hmac);
		}
		return $request->urlencode($signature);
	}


	/**
	 * Check if the request signature corresponds to the one calculated for the request.
	 * 
	 * @param OAuthRequest request
	 * @param string base_string	data to be signed, usually the base string, can be a request body
	 * @param string consumer_secret
	 * @param string token_secret
	 * @param string signature		from the request, still urlencoded
	 * @return string
	 */
	public function verify ( $request, $base_string, $consumer_secret, $token_secret, $signature )
	{
		$a = $request->urldecode($signature);
		$b = $request->urldecode($this->signature($request, $base_string, $consumer_secret, $token_secret));

		// We have to compare the decoded values
		$valA  = base64_decode($a);
		$valB  = base64_decode($b);

		// Crude binary comparison
		return rawurlencode($valA) == rawurlencode($valB);
	}
}


/* vi:set ts=4 sts=4 sw=4 binary noeol: */

?>