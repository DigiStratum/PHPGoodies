<?php
/**
 * PHPGoodies:Oauth2AccessToken - Oauth2 Access Token
 *
 * Oauth2 Access tokens are essentially a distinctive string representation of a data structure that
 * describes authentication/access/validity details about an Oauth2 "session". There are several
 * methods of translating from the AccessToken string form to the data form, and the Oauth2 spec
 * itself leaves this up to the implementor to decide. Our implementation is going to use a Hash to
 * represent the data encoded into the token and to/from string methods to get the string form of
 * the token data and back again. An though it would be a conceptually simple matter to use a
 * database to store the data with the token string as a refernece to it, we're going to optimize a
 * bit by eliminating the database and encoding the data directly into the token string.
 *
 * There are some fairly fancy ways of doing this using public key cryptography and such so that
 * anyone with the public key can decode and read the details while we are the only ones who can
 * encode with the private key. However, in an effort to keep the baseline implementation simple
 * we are instead going to rely on a simple secret 2-way cipher which still keeps us in the
 * base64 character set but precludes any other application from decoding the token without the
 * secret.
 *
 * @uses Hash
 * @uses Secret64
 * @uses Oauth2AccessTokenIfc
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Data.Hash');
PHPGoodies::import('Lib.Net.Http.Oauth2.Oauth2AccessTokenIfc');

/**
 * Oauth2 Access Token
 */
class Oauth2AccessToken extends Hash implements Oauth2AccessTokenIfc {

	/**
	 * Our instance of Secret64 for en/decode
	 */
	protected $s64;

	/**
	 * Constructor
	 */
	public function __construct($secret) {

		// Make our Secret64 en/decoder with the seed
		$this->s64 = PHPGoodies::instantiate('Lib.Crypto.Secret64', $secret);
	}

	/**
	 * Convert our token data into an access token string
	 *
	 * @return string A token string which may be decoded by fromToken()
	 */
	public function toToken() {
		$obj = (object) $this->all();
		$json = json_encode($obj);
		return $this->s64->encode($json);
	}

	/**
	 * Fill our token data from an access token string
	 *
	 * @param string $token A token string produced by toToken()
	 *
	 * @return boolean true on successful decode, else false
	 */
	public function fromToken($token) {
		$json = $this->s64->decode($token);
		$data = json_decode($json, true);
		if (null === $data) return false;

		// Empty our data structure and fill it with the token contents
		$this->nil();
		foreach ($data as $name => $value) {
			$this->set($name, $value);
		}

		return true;
	}
}

