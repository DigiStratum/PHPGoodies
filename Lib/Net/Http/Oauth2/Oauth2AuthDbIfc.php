<?php
/**
 * PHPGoodies:Oauth2AuthDbIfc - Oauth2 Authorization Database Interface
 *
 * Any class implementing this interface will be usable as an AuthDb for the AuthServer to check
 * user authentication credentials
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Oauth2 Authorization Database Interface
 */
interface Oauth2AuthDbIfc {

	/**
	 * Check whether the specified credentials are valid for authentication
	 *
	 * @param string $username The username we want to look up
	 * @param string $password The password we want to compare
	 *
	 * @return mixed integer ID for the matching user, or null if not found
	 */
	public function checkCredentials($usernme, $password);
}
