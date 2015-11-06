<?php
/**
 * PHPGoodies:Validator - A collection of general purpose validators
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Validator - A collection of general purpose validators
 */
abstract class Validators {

	// -----------------------------------------------------------------------------------------
	// STRINGS
	// -----------------------------------------------------------------------------------------

	/**
	 * Validate that the argument is a non-empty string
	 *
	 * @param mixed $a Whatever we want to check with this validator
	 *
	 * @return boolean true if the validator is satisfied with the argument, else false
	 */
	public static function isString($a) {
		return gettype($a) == 'string';
	}

	/**
	 * Validate that the argument is a non-empty string
	 *
	 * @param mixed $a Whatever we want to check with this validator
	 *
	 * @return boolean true if the validator is satisfied with the argument, else false
	 */
	public static function isNonEmptyString($a) {
		if (! self::isString($a)) return false;
		return strlen($a) > 0;
	}

	// -----------------------------------------------------------------------------------------
	// FILE SYSTEM
	// -----------------------------------------------------------------------------------------

	/**
	 * Validate that the argument is a directory
	 *
	 * @param mixed $a Whatever we want to check with this validator
	 *
	 * @return boolean true if the validator is satisfied with the argument, else false
	 */
	public static function isDirectory($a) {
		if (! self::isNonEmptyString($a)) return false;
		return is_dir($a);
	}

	/**
	 * Validate that the argument is a writable directory
	 *
	 * @param mixed $a Whatever we want to check with this validator
	 *
	 * @return boolean true if the validator is satisfied with the argument, else false
	 */
	public static function isWritableDirectory($a) {
		if (! self::isDirectory($a)) return false;
		return is_writable($a);
	}
}

