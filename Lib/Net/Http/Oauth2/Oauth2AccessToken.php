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
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Oauth2 Access Token
 */
class Oauth2AccessToken {

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
	 * Translate token data into an access token string
	 *
	 * @param object Hash instance with token data in it
	 *
	 * @return string A token string which represents the supplied data
	 */
	public function dataToToken($hash) {
		PHPGoodies::import('Lib.Data.Hash');
		if (! $hash instanceof Hash) {
			throw new \Exception('Something other than a Hash supplied for token data');
		}
		$obj = (object) $hash->all();
		$json = json_encode($obj);
		return $this->s64->encode($json);
	}

	/**
	 * Get token data from the supplied access token string
	 *
	 * @param string $token A token string produced by toToken()
	 *
	 * @return object Hash instance populated with data on success, else null
	 */
	public function tokenToData($token) {
		$json = $this->s64->decode($token);
		$data = json_decode($json, true);
		if (null === $data) return null;

		// Empty our data structure and fill it with the token contents
		$hash = PHPGoodies::instantiate('Lib.Data.Hash');
		foreach ($data as $name => $value) {
			$hash->set($name, $value);
		}

		return $hash;
	}
}

