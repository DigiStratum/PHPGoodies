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
	 * @param string $name member name prospective that we want to check
	 */
	public static function isValidMemberName(string $name) {

		// Empty and null strings are definitely not valid...
		if (is_null($name) || (0 === strlen($name))) return false;

		// "Global" set only if 1 char, otherwise, bookend "additional" chars between global chars
		$pattern = (1 === strlen($name)) ? '/^[A-Za-z0-9]$/' : '/^[A-Za-z0-9]+[A-Za-z0-9_- ]*[A-Za-z0-9]+$/';
		return preg_match($pattern, $name);
	}
}

