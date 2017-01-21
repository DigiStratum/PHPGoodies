<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_Member - Helper class for JSON:API Members
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Helper class for JSON:API Members
 */
class Lib_Net_Api_Rest_JsonApi_Server_Member {

	/**
	 * Is the supplied name valid for a JSON:API Member?
	 *
	 * Note: JSON:API spec calls for allowance of U0080+, but recommends against; we are leaving
	 * out this support since it is specifically recommended against.
	 *
	 * @param $name String member name prospective that we want to check
	 */
	public static function isValidMemberName($name) {
		return preg_match('/^[A-Za-z0-9][A-Za-z0-9_- ]*[A-Za-z0-9]$/', $name);
	}
}

