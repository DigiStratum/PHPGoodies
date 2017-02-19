<?php
/**
 * PHPGoodies:Lib_Net_Api_Rest_JsonApi_Server_UriPattern - JSON:API Class for comparing URIs to patterns
 *
 * @uses Oop_Type
 * @uses Oop_Dto_Dtos_Generic
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Oop.Type');
PHPGoodies::import('Oop.Dto.Dtos.Generic');

/**
 * JSON:API Class for comparing URIs to patterns
 */
class Lib_Net_Api_Rest_JsonApi_Server_UriPattern {

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
	protected $variables;

	/**
	 * Constructor
	 *
	 * @param string $pattern The pattern string we want to use
	 */
	public function __construct($pattern) {
		$this->pattern = Oop_Type::requireType($pattern, 'string');
		$this->patternToRegex($pattern);
	}

	/**
	 * Get the variables from the supplied URI
	 *
	 * @param string $uri The URI of the request we want to match against our pattern
	 *
	 * @return object Dto with the URI variables set as named properties, or null if no match
	 */
	public function getUriVariables($uri) {

		// If there's no match on the URI, null is the result
		$matches = $this->getRegexMatches($uri);
		if (is_null($matches)) return null;

		// If there are no variables of interest, the empty DTO is the result
		$dto = PHPGoodies::instantiate('Oop.Dto.Dtos.Generic', array_keys($this->variables));
		if (! count($this->variables)) return $dto;

		// Fill the DTO up with the variables' values (skip the 0th element)
		for ($v = 1; $v < count($matches); $v++) {
			$dto->set($this->variables[$v - 1]->name, $matches[$v]);
		}
		return $dto;
	}

	/**
	 * Check whether the supplied URI matches our pattern
	 *
	 * @param string $uri The URI of the request we want to match against our pattern
	 *
	 * @return boolean true if the URI satisfies our pattern, else false
	 */
	public function matchesUri($uri) {
		return (! is_null($this->getRegexMatches($uri)));
	}

	/**
	 * Run the regex for this pattern against the supplied URI and get the matches
	 *
	 * Note: the matches will always return an array with at least one element which is the full
	 * string match for the regex, which should be the same as the URI... if there are variable
	 * components in the URI and pattern, then they will be added, in order, to the set of
	 * matches following the 0th element.
	 *
	 * @param string $uri The URI of the request we want to match against our pattern
	 *
	 * @return Array of regex matches if a match occurred, or null if no match
	 */
	private function getRegexMatches($uri) {
		$turi = Oop_Type::requireType($uri, 'string');
		return preg_match($this->regex, $turi, $matches) ? $matches : null;
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
		$variables = Array();
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
					$variable = new \StdClass();
					$variable->name = $varName;
					$variable->type = $type;
					$variables[] = $variable;
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

		// Capture the resulting pattern regex and variables
		$this->regex = $regex;
		$this->variables = $variables;
	}
}

