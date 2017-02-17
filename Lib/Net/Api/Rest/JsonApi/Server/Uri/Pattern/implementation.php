<?php
/**
 * PHPGoodies:Lib_Net_Api_Rest_JsonApi_Server_Uri_Pattern - JSON:API Class for comparing URIs to patterns
 *
 * @uses Oop_Type
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Oop.Type');

/**
 * JSON:API Class for comparing URIs to patterns
 */
class Lib_Net_Api_Rest_JsonApi_Server_Uri_Pattern {

	/**
	 * The pattern string we will use
	 */
	protected $pattern;

	/**
	 * The regex equivalent of this pattern which we'll use to match Uri's
	 */
	protected $regex;

	/**
	 * The variable names from this Pattern which get extracted from matching Uri's
	 */
	protected $varNames;

	/**
	 * Constructor
	 *
	 * @param string $pattern The pattern string we want to use
	 */
	public function __construct($pattern) {
		$this->pattern = Oop_Type::requireType($pattern, 'string');
		$this->patternToRegex($pattern);
	}

	public function toRegex() {
		return $this->regex;
	}

	public function matchesUri($uri) {
		return (preg_match($this->regex, $uri) == 1);
	}

	/**
	 * Convert the supplied pattern to a regular expression
	 *
	 * We will convert the pattern to a regex so that we can extract components out of a given
	 * URI using the regex. Here we will assess the supplied pattern for conformance and, if we
	 * find any deviations, thrown an exception which prevents the successful instantiation of
	 * this class.
	 *
	 * @param string $pattern The pattern string we want to use
	 *
	 */
	private function patternToRegex($pattern) {
		// "/path/{#number}/dir/{$string}"
		$regex = '/^';
		$var = false;
		$varName = '';
		$varNames = Array();
		$typing = false;
		$type = '';
		for ($xx = 0; $xx < strlen($pattern); $xx++) {
			switch ($pattern[$xx]) {
				case '/':
					$regex .= "\\/";
					break;

				case '{':
					if ($var) {
						throw new \Exception("Bad pattern ['{$pattern}'], already in the middle of a variable identifier at character {$xx}");
					}
					$var = $typing = true;
					$varName = '';
					break;

				case '}':
					if (! $var) {
						throw new \Exception("Bad pattern ['{$pattern}'], not in the middle of a variable identifier at character {$xx}");
					}
					if (strlen($varName) == 0) {
						throw new \Exception("Bad pattern ['{$pattern}'], zero length variable identifier at character {$xx}");
					}
					$var = false;
					$varNames[$varName] = $type;
					switch ($type) {
						case 'number': $regex .= '(\d+)'; break;
						case 'string': $regex .= '(\w+)'; break;
					}
					break;

				case '\\':
					$regex .= '\\\\';
					$esc = false;
					break;

				default:
					if ($var) {
						if ($typing) {
							switch ($pattern[$xx]) {
								case '#': $type = 'number'; break;
								case '$': $type = 'string'; break;
								default:
									throw new \Exception("Bad pattern ['{$pattern}'], variable type must be '#' or '$' at character {$xx}");
							}
							$typing = false;
						}
						else $varName .= $pattern[$xx];
					}
					else $regex .= $pattern[$xx];
					break;
			}
		}
		if ($var) {
			throw new \Exception("Bad pattern ['{$pattern}'], unterminated variable identifier at character {$xx}");
		}
		$regex .= '$/';

		// Capture the resulting pattern regex and varNames
		$this->regex = $regex;
		$this->varNames = $varNames;
	}
}

