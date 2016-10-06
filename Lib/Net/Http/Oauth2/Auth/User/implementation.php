<?php
/**
 * PHPGoodies:Lib_Net_Http_Oauth2_Auth_User - Oauth2 Authentication Database User Record
 *
 * This is the basic authentication user data that the AuthDb should return. If a custom authDb
 * implementation requires additional properties, then a custom, extended version of this class
 * should be created and returned/managed by the AuthDb. A proper extension with additional
 * properties may need only override the constructor. A given application may want to know any
 * number of details about an authenticated user, but the data stored here should be limited to
 * just the information pertinent to authenticating/authorizing the user - all other details should
 * be left to some other realm of responsibility.
 *
 * @uses Lib_Data_Hash
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Oauth2 Authentication Database User Record
 */
class Lib_Net_Http_Oauth2_Auth_User {

	/**
	 * The scopes that this user will be authorized for when queried
	 */
	protected $authorizedScopes = array();

	/**
	 * This user's data (application specific)
	 */
	protected $data;

	/**
	 * Constructor
	 */
	public function __construct($userId, $userName) {
		$this->data = PHPGoodies::instantiate('Lib.Data.Hash');
		$this->data->set('userId', $userId);
		$this->data->set('userName', $userName);
	}

	/**
	 * Get the data for this Auth User
	 *
	 * @return object A StdClass object with all the data properties pulbicly accessible
	 */
	public function getData() {

		// Data is an object form of all data from the Hash...
		$data = (object) $this->data->all();

		// ... plus a list of authorized scopes
		$data->authorizedScopes = array_keys($this->authorizedScopes);

		return $data;
	}

	/**
	 * Authorize the named scope for this user
	 *
	 * @param string $scopeName The plain text scope name we want to authorize for this user
	 *
	 * @return object $this for chaining support...
	 */
	public function authorizeScope($scopeName) {
		$this->authorizedScopes[$scopeName] = true;
		return $this;
	}
}

