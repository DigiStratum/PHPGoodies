<?php
/**
 * PHPGoodies:Lib_File_Json - A class for manipulating Json data
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Json - A class for manipulating Json data
 */
class Lib_File_Json {

	/**
	 * Constructor
	 */
	public function __construct() {
	}

	/**
	 * Compose the indicated Json file
	 *
	 * "Composition" is the process where we look for our own magic tags within the Json data
	 * and perform substitutions.
	 *
	 * @param string $filename Json file that we want to compose
	 */
	public function composeJsonFile($filename) {
		$json = @file_get_contents($filename);
		return $this->composeJson($json);
	}

	/**
	 * Compose the supplied Json
	 *
	 * "Composition" is the process where we look for our own magic tags within the Json data
	 * and perform substitutions.
	 *
	 * @param string $json The Json that we want to compose
	 */
	public function composeJson($json) {
		return $this->composeJsonData(json_decode($json));
	}

	/**
	 *
	 */
	public function composeJsonData($data) {
		if (null == $data) return $data;
		
		// Only strings may be composed, whether object properties, array values, or bare strings
		if (is_string($data)) {
			return $this->composeJsonString($data);
		}
		else if (is_object($data)) {
			return $this->composeJsonObject($data);
		}
		else if (is_array($data)) {
			return $this->composeJsonArray($data);
		}

		// Any other data type will be returned unmodified
		return $data;
	}

	/**
	 *
	 */
	public function composeJsonObject($data) {
		// TODO: Iterate over object properties and call composeJsonData() for each one
		// TODO: Prevent recursion if possible to detect
	}

	/**
	 *
	 */
	public function composeJsonArray($data) {
		// TODO: Iterate over array values and call composeJsonData() for each one
	}

	/**
	 *
	 *
	 * This is the fundamental data type which is composable
	 *
	 */
	public function composeJsonString($data) {
		// TODO:
	}
}

