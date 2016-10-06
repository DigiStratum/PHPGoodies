<?php
/**
 * PHPGoodies:Oauth2AuthServer - Oauth2 Authorization Server
 *
 * ref: http://tools.ietf.org/html/rfc6749
 *
 * @uses Lib_Data_Hash
 * @uses Lib_Net_Http_Request
 * @uses Lib_Net_Http_Oauth2_Auth_Db
 * @uses Lib_Net_Http_Oauth2_AccessToken
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Http.Oauth2.Oauth2_Auth_Db');
PHPGoodies::import('Lib.Net.Http.Oauth2.Oauth2_AccessToken');

/**
* Oauth2 Authorization Server
*/
class Oauth2AuthServer {

	// TODO - Get configurations from an outside source...
	const TOKEN_EXPIRES_SECONDS = 600;

	/**
	 * Enforce requests be made over TLS (HTTPS)
	 */
	protected $requireTls = true;

	/**
	 * The registered clients that we will recognize
	 */
	protected $registeredClients;

	/**
	 * The Oauth2AuthDbIfc instance we'll use to check user credentials
	 */
	protected $authdb;

	/**
	 * The Oauth2AccessToken instance we'll use to encode and decode tokens
	 */
	protected $accessToken;

	/**
	 * Constructor; dependency injection
	 *
	 * @param object $authDb A class instance implementing Oauth2AuthDbIfc interface
	 * @param object $accessToken A class instance of Oauth2AccessTokenIfc
	 */
	public function __construct(&$authDb, &$accessToken) {

		// Capture reference to the authDb; it is read-only for us so we don't need a copy
		if (! $authDb instanceof Lib_Net_Http_Oauth2_Auth_Db) {
			throw new \Exception('Something other than an Oauth2AuthDbIfc supplied for the AuthDb');
		}
		$this->authDb =& $authDb;

		if (! $accessToken instanceof Lib_Net_Http_Oauth2_AccessToken) {
			throw new \Exception('Something other than an Oauth2AccessToken supplied for the AccessToken');
		}
		$this->accessToken =& $accessToken;

		$this->registeredClients = PHPGoodies::instantiate('Lib.Data.Hash');
	}

	/**
	 * Setter for require TLS state
	 *
	 * @param boolean $state True to require TLS for all requests, false to make TLS optional
	 *
	 * @return object $this for chaining support...
	 */
	public function setRequireTls($state) {
		$this->requreTls = $state ? true : false;
	}

	/**
	 * Add a registered client to the list
	 *
	 * @param string $clientId The oauth2 client_id
	 * @param string $clientSecret The oauth2 client_secret
	 *
	 * @return object $this for chaining support...
	 */
	public function addRegisteredClient($clientId, $clientSecret) {
		$this->registeredClients->add($clientId, $clientSecret);
		return $this;
	}

	/**
	 * Check whether we have a registered client with the specified clientId
	 *
	 * @param string $clientId The oauth2 client_id
	 *
	 * @return boolean true if we have the clientId registered, else false
	 */
	public function hasRegisteredClient($clientId) {
		return $this->registeredClients->has($clientId);
	}

	/**
	 * Check whether the supplied secret matches that of the specified client
	 *
	 * @param string $clientId The oauth2 client_id
	 * @param string $clientSecret The oauth2 client_secret
	 *
	 * @return boolean true if the secrets match, else false
	 */
	protected function doesSecretMatchRegisteredClient($clientId, $secret) {
		if (! $this->hasRegisteredClient) return false;
		$clientSecret = $this->registeredClients->get($clientId);
		return ($secret === $clientSecret);
	}

	/**
	 * Check whether the HttpRequest's credentials are for an authorized client
	 *
	 * From RFC:
	 * The authorization server MUST support the HTTP Basic authentication scheme for
	 * authenticating clients that were issued a client password.
	 *
	 * @param object $httpRequest An HttpRequest instance
	 *
	 * @return boolean true if request has a registered client with password match, else false
	 */
	protected function isAuthorizedClient(&$httpRequest) {

		// Make sure we got an HttpRequest object
		if (! $httpRequest instanceof Lib_Net_Http_Request) {
			throw new \Exception('Something other than an HttpRequest supplied');
		}

		// Get the request data and ensure that it has an Authorization header
		$request = $httpRequest->getInfo();
		if (! $request->headers->has('Authorization')) return false;

		// Extract clientId and clientSecret from the Authorization header
		$auth = base64_decode($request->headers->get('Authorization'));
		list ($method, $data) = explode(' ', $auth);
		if (strtolower($method) != 'basic') return false;
		list ($clientId, $secret) = explode(':', $data);

		// The request is an authorized client if there's a registered match
		return $this->doesSecretMatchRegisteredClient($clientId, $secret);
	}

	/**
	 * Generate tokens for requests to the token endpoint
	 *
	 * @param object $httpRequest An HttpRequest instance
	 *
	 * @reutn string Access token string, or null on error
	 */
	public function getAccessToken(&$httpRequest) {

		// Make sure we got an HttpRequest object
		if (! $httpRequest instanceof Lib_Net_Http_Request) {
			throw new \Exception('Something other than an HttpRequest supplied');
		}

		// Request must be accompanied by an authorized client
		if (! $this->isAuthorizedClient($httpRequest)) return null;

		// Get the request data and ensure that it meets our requirements
		$request = $httpRequest->getInfo();
		if ($this->requireTls && ($request->protocol != 'HTTPS')) return null;
		if ($request->method != 'POST') return null;

		// Get the AuthUser for the supplied user credentials
		$username = $request->data->get('username');
		$password = $request->data->get('password');
		$authUser = $this->authDb->getAuthenticatedUser($username, $password);
		if (null == $authUser) return null;

		// Generate a token string
		$tokenData = PHPGoodies::instantiate('Lib.Data.Hash');
		$tokenData->set('tokenType', 'bearer');
		$tokenData->set('expires', time() + TOKEN_EXPIRES_SECONDS);
		$tokenData->set('authUser', $authUser);

		return $this->accessToken->dataToToken($tokenData);
	}

	/**
	 * Check the token for scope authorization (on resource endpoints)
	 *
	 * @param object $httpRequest An HttpRequest instance
	 * @param string $scope The scope that we want to look for in this token
	 *
	 * @return true if the token authorization has the named scope in it, else false
	 */
	public function hasScopeAuthorization(&$httpRequest, $scope) {

		// Make sure we got an HttpRequest object
		if (! $httpRequest instanceof Lib_Net_Http_Request) {
			throw new \Exception('Something other than an HttpRequest supplied');
		}

		// Get the request data and ensure that it meets our requirements
		$request = $httpRequest->getInfo();
		if ($this->requireTls && ($request->protocol != 'HTTPS')) return false;
		if (! $request->headers->has('Authorization')) return false;

		// Extract the authorization method and data from the header
		$auth = base64_decode($request->headers->get('Authorization'));
		list ($method, $data) = explode(' ', $auth);

		// Expect the authorization method to be a bearer token
		if (strtolower($method) != 'bearer') return false;
		$tokenData = $this->accessToken->tokenToData($data);
		if (is_null($tokenData)) return false;

		// Expect there to be an authUser structure in the token data
		if (! $tokenData->has('authUser')) return false;
		$authUser = $tokenData->get('authUser');

		// Expect authorizedScopes to be an array with the requested scope in it
		if (! is_array($authUser->authorizedScopes)) return false;
		return in_array($sopce, $authUser->authorizedScopes);
	}
}

