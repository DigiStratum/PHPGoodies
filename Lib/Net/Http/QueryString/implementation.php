<?php
/**
 * PHPGoodies:Lib_Net_Http_QueryString - A non-instantiable class with static methods for query strings
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * QueryString 
 */
abstract class Lib_Net_Http_QueryString {

	/**
	* Formats the supplied data array as a query string
	*
	* Note that while name is always a simple string, value may be either a simple string/number
	* or an array of simple string/numbers.
	*
	* @param array $data Associative array of name=value pairs
	* @param string $sep Single-character separator between pairs; should be ';' or '&',
	* 		     optional, defaults to '&'
	*
	* @return string URL-encoded query string with the data (may be 0-length if no data)
	*/
	public static function getDataAsQueryString($data, $sep = '&') {

		// No data means no query string
		if (! is_array($data)) return '';

		$queryString = '';
		foreach ($data as $name => $value) {
			if (is_array($value)) foreach ($value as $val) {
				$queryString .= $sep . urlencode($name) . '=' . urlencode($val);
			}
			else $queryString .= $sep . urlencode($name) . '=' . urlencode($value);
		}

		return $queryString;
	}

	/**
	 * Formats the supplied query string as an associative array of name/value pairs
	 *
	 * Note that this is the inverse of f.getDataAsQeryString().
	 *
	 * @param string $queryString The URL-encoded query string that we want to process
	 *
	 * @return array Associative array of name=value pairs
	 */
	public static function getQueryStringAsData($queryString) {

		// Here's the data set we will be filling up and returning
		$data = array();

		// Either ';' or '&' are legitimate separators, so we'll support both
		$sep = (false !== strpos($queryString, ';')) ? ';' : '&';

		// Break up the query string into its pairs
		$pairs = explode($sep, $queryString);
		foreach ($pairs as $pair) {
			// Break pair into name/value parts at the '='
			$parts = explode('=', $pair);

			// There is always a name
			$name = urldecode($parts[0]);

			// There may be a value
			$value = isset($parts[1]) ? urldecode($parts[1]) : null;

			// If this data element is not already in place, then we'll use a single value
			if (! isset($data[$name])) {
				$data[$name] = $value;
			}
			else {
				// Something is already in this data element - is it an array?
				if (is_array($data[$name])) {
					// Sweet - just add this value to the array
					$data[$name][] = $value;
				}
				else {
					// Convert it to an array and make the current
					// value and the new one the first two elements
					$data[$name] = array(
						$data[$name],
						$value
					);
				}
			}
		}

		return $data;
	}
}

