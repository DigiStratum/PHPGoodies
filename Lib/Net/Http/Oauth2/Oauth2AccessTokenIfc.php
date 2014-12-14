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
	 * @return string An AccessToken which may be decoded by fromString()
	 */
	public function toString();

	/**
	 * Fill our token data from an access token string
	 *
	 * @param string $accessToken An Oauth2 AccessToken produced by toString()
	 *
	 * @return boolean true on successful decode, else false
	 */
	public function fromString($accessToken);
}

