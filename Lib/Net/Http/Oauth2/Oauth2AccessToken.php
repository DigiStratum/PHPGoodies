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
 * @uses Secret64
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Oauth2 Access Token
 */
class Oauth2AccessToken extends Hash implements Oauth2AccessTokenIfc {

	/**
	 * Our token data
	 */
	protected $data = array();

	/**
	 * Our instance of Secret64 for en/decode
	 */
	protected $s64;

	/**
	 * Constructor
	 */
	public function __construct($secret) {

		// Convert secret string into a numeric seed
		$seed = 0;
		for ($xx = 0; $xx < strlen($secret); $xx++) {
			$seed += ord($secret{$xx});
		}

		// Make our Secret64 en/decoder with the seed
		$this->s64 = PHPGoodies::instantiate('Lib.Crypto.Secret64', $seed);
	}

	/**
	 * Convert our token data into an access token string
	 *
	 * @return string An AccessToken which may be decoded by fromString()
	 */
	public function toString($data) {
		if (! is_array($data)) {
			throw new \Exception('Token data must be supplied as an associative array');
		}
		$this->data = $data;
		$obj = (object) $this->data;
		$json = json_encode($obj);
		return $this->s64->encode($json);
	}

	/**
	 * Fill our token data from an access token string
	 *
	 * @param string $accessToken An Oauth2 AccessToken produced by toString()
	 *
	 * @return boolean true on successful decode, else false
	 */
	public function fromString($accessToken) {
		$json = $this->s64->decode($accessToken);
		$data = json_decode($json, true);
		if ((null === $data) || (! is_array($data))) return false;

		// Empty our data structure and fill it with the token contents
		$this->data = $data;

		return true;
	}
}

