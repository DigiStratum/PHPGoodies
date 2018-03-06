<?php
/**
 * PHPGoodies:Lib_File_Json - A class for manipulating Json data
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Json - A class for manipulating Json data
 *
 * "Composition" is the process where we look for our own magic tags within the JSON data
 * and perform substitutions.
 *
 * TODO: Add support for image embedding like: <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAIAAAB=" />
 */
class Lib_File_Json {

	protected $stack = array();
	protected $jsonDir;

	/**
	 * Constructor
	 */
	public function __construct($jsonDir = null) {
		if (is_dir($jsonDir)) $this->jsonDir = $jsonDir;
	}

	/**
	 * Compose the indicated JSON file
	 *
	 * @param string $filename JSON file that we want to compose
	 *
	 * @return mixed data structure of the composed JSON
	 *
	 * @throws Exception on errors and/or missing files
	 */
	public function composeJsonFile($filename) {

		// If our working jsonDir is null, then just use the dir of this file
		if (is_null($this->jsonDir)) {
			$dir = dirname($filename);
			if (is_dir($dir)) {
				$this->jsonDir = $dir;
			}
		}

		// Make sure we have a reasonable dir to work in
		if (is_null($this->jsonDir)) {
			throw new \Exception("No working dir provided to load JSON files from.");
		}

		// Is this a relative filename?
		if (basename($filename) == $filename) {
			// Make it relative to jsonDir
			$filename = $this->jsonDir . DIRECTORY_SEPARATOR . $filename;
		}

		// Use a stack to prevent infinite file-reference recursion
		if (in_array($filename, $this->stack)) {
			throw new \Exception("Infinite file-reference recursion: {$filename}");
		}
		array_push($this->stack, $filename);

		$json = $this->readFile($filename);
		$data = $this->composeJson($json);

		// Remove ourselves from the stack
		array_pop();

		return $data;
	}

	/**
	 * Compose the supplied JSON
	 *
	 * @param string $json The JSON that we want to compose
	 *
	 * @return mixed data structure of the composed JSON
	 */
	public function composeJson($json) {
		if (is_null($json)) return null;
//		return $this->composeJsonData(json_decode($json));
	}

	/**
	 * Compose the supplied data structure (sourced from JSON, reentrant)
	 *
	 * Dispatch the composition of the data structure to one of the helper methods depending on
	 * the data type which must be processed.
	 *
	 * @param mixed $data Any object, array, string, or primitive (other types are out of scope)
	 *
	 * @return mixed data structure of the composed JSON
	 */
	protected function composeJsonData($data) {
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
	 * Compose all the properties of this object
	 *
	 * TODO: Prevent recursion if possible to detect
	 *
	 * @param object $data Object whose properties we want to compose
	 *
	 * @returns object with properties all composed (recursively) 
	 */
	protected function composeJsonObject($data) {

		// Return non-objects unmodified
		if (! is_object($data)) return $data;

		// Iterate over object properties and call composeJsonData() for each one
		foreach ($data as $key => $value) {
			$data->{$key} = $this->composeJsonData($data->{$key});
		}
		return $data;
	}

	/**
	 * Compose all the elements of this array
	 *
	 * TODO: Prevent recursion if possible to detect
	 *
	 * @param array $data Array whose elements we want to compose
	 *
	 * @returns array with elements all composed (recursively) 
	 */
	protected function composeJsonArray($data) {

		// Return non-arrays unmodified
		if (! is_array($data)) return $data;

		// Iterate over array elements and call composeJsonData() for each one
		foreach ($data as $key => $value) {
			$data[$key] = $this->composeJsonData($data[$key]);
		}
		return $data;
	}

	/**
	 * Compose the JSON for a given String
	 *
	 * This is the fundamental data type which is composable; if there is anything to be composed,
	 * it is here. To be composable, the string must start with '{{' followed by one of our key
	 * words which have significance, zero or more name=value properties pairs and end with '}}'.
	 * If there is no match on this pattern with one of our key words, then the string will be
	 * returned unmodified.
	 *
	 * @param string $data The string which we want to compose against
	 *
	 * @return mixed data with the result of the composition
	 */
	protected function composeJsonString($data) {

		// Return non-strings unmodified
		if (! is_string($data)) return $data;

		// Includes: {{replace src='filename.json'}}
		if (preg_match('/^\{\{replace\s+src\s*=\s*\'(.*?)\'\s*\}\}$/i', $data, $matches)) {
			$filename = $matches[1];
			return $this->composeJsonFile($filename);
		}

 		// Embed images as: <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAIAAAB=" />
		// "{{encode method='data:image' src='thumb3.png'}}"
		if (preg_match('/^\{\{encode\s+method\s*=\s*\'(.*?)\'\s+src\s*=\s*\'(.*?)\'\s*\}\}$/i', $data, $matches)) {
			$method = $matches[1];
			$filename = $matches[2];

			$fileData = $this->readFile($filename);
			switch ($method) {
				case 'data:image':
					$fileData = base64_encode($fileData);
					$info = pathinfo($filename);
					return("data:image/{$info['extension']};base64,{$fileData}");

				case 'raw': return $fileData;

				default:
					throw new \Exception("Unknown encoding method: '{$method}'");
			}
		}

		return $data;	
	}

	/**
	 * Read data from a file
	 *
	 * TODO: Move to IOWrapper some day...
	 *
	 * @param string $filename The file we want to read
	 *
	 * @returns string data from the file that we read
	 *
	 * @throws Exception on errors and/or missing files
	 */
	protected function readFile($filename) {

		// Make sure the requested file exists
		if (! file_exists($filename)) {
			throw new \Exception("Cannot find file: {$filename}");
		}

		$res = @file_get_contents($filename);

		if (false !== $res) return $res;

		throw new \Exception("Error reading from file: {$filename}");
	}

}

