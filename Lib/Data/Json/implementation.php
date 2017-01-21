<?php
/**
 * PHPGoodies:Lib_Data_Json - Wrap PHP's native JSON handling functions with OOP
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 *  * Hash
 *   */
class Lib_Data_Json {

	/**
	 * Map of error codes to meaningful messages
	 */
	protected static $errorStrings = array(
		JSON_ERROR_DEPTH => 'Max stack depth exceeded',
		JSON_ERROR_STATE_MISMATCH => 'Invalid JSON',
		JSON_ERROR_CTRL_CHAR => 'Encoding/Control character error',
		JSON_ERROR_SYNTAX => 'Syntax error',
		JSON_ERROR_UTF8 => 'Encoding/Malformed UTF-8 character error'
	);

	/**
	 * Encode a given data value into a JSON string
	 *
	 * @param $value mixed Anything from a primitive data type to a complex array/object
	 * @param $options Integer flags as a bitmask; ref: http://php.net/json_encode
	 *
	 * @return String JSON value if successful
	 *
	 * @throws Exception on error
	 */
	protected static function encode($value, $options = 0) {
		$res = @json_encode($value, $options);
		if ($res) return $res;
		throw new \Exception("Lib_Data_Json::encode error: " . static::$errorStrings[json_last_error()]);
	}

	/**
	 * Decode a given JSON string into a data value
	 *
	 * @param $json String JSON data to be decoded
	 * @param $assoc Boolean optional flag to force the resulting object data value to be an associative array
	 *
	 * @return Mixed data value represented by the JSON if successful
	 *
	 * @throws Exception on error
	 */
	protected static function decode($json, $assoc = false) {
		$res = @json_decode($json, $assoc);
		if ($res) return $res;
		throw new \Exception("Lib_Data_Json::decode error: " . static::$errorStrings[json_last_error()]);
	}
}

