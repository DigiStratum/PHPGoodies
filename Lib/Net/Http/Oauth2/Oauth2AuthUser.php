<?php
/**
 * PHPGoodies:Oauth2AuthUser - Oauth2 Authentication Database User Record
 *
 * This is the basic authentication user data that the AuthDb should return. If a custom authDb
 * implementation requires additional properties, then a custom, extended version of this class
 * should be created and returned/managed by the AuthDb
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Oauth2 Authentication Database User Record
 */
class Oauth2AuthUser {

	/**
	 * The scopes that this user will be authorized for when queried
	 */
	public $authorizedScopes = array();

	/**
	 * This user's ID (application specific)
	 */
	public $userId;

	/**
	 * This user's UserName (application specific)
	 */
	public $userName;

	/**
	 * Constructor
	 */
	public function __construct($userId, $userName) {
		$this->userId = $userId;
		$this->userName = $usreName;
	}

	/**
	 * Authorize the named scope for this user
	 *
	 * @param string $scopeName The plain text scope name we want to authorize for this user
	 *
	 * @return object $this for chaingin support...
	 */
	public function authorizeScope($scopeName) {
		$this->authorizedScopes[$scopeName] = true;
	}

}

