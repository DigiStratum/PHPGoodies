<?php
/**
 * PHPGoodies:Oauth2AccessTokenIfc - Oauth2 Access Token Interface
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Oauth2 Access Token Interface
 */
interface Oauth2AccessTokenIfc {

	/**
	 * Convert our token data into an access token string
	 *
	 * @param mixed $data Token data; it really should be something structured...
	 *
	 * @return string A token string which may be decoded by fromToken()
	 */
	public function toToken($data);

	/**
	 * Fill our token data from an access token string
	 *
	 * @param string $token A token string produced by toToken()
	 *
	 * @return boolean true on successful decode, else false
	 */
	public function fromToken($token);
}

