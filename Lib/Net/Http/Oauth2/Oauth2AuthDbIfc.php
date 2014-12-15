<?php
/**
 * PHPGoodies:Oauth2AuthDbIfc - Oauth2 Authentication Database Interface
 *
 * Any class implementing this interface will be usable as an AuthDb for the AuthServer to check
 * user authentication credentials. Any implementation will need to use Oauth2AuthUser.
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Oauth2 Authentication Database Interface
 */
interface Oauth2AuthDbIfc {

	/**
	 * Gets authenticated user info if the specified credentials are valid
	 *
	 * @param string $username The username we want to look up
	 * @param string $password The password we want to compare
	 *
	 * @return object Oauth2AuthUser record for the matching user, or null if not found
	 */
	public function getAuthenticatedUser($username, $password);
}

