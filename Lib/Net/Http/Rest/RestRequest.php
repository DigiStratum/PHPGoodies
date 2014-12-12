<?php
/**
 * PHPGoodies:RestRequest - RESTful API Request Extension of HttpRequest
 *
 * @uses HttpResponse
 * @uses Dto
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Http.HttpRequest');

/**
 * RESTful API Request Extension of HttpRequest
 */
class RestRequest extends HttpRequest {

	/**
	 * The URI pattern that this request matches
	 */
	protected $uriPattern = '';

	/**
	 * The URI-encoded params
	 */
	protected $uriParams = array();

	/**
	 * Constructor - does nothing but set up the empty data structure
	 *
	 * Note: pass false for the initCurrentRequest initializer if you want to make your own new
	 * HttpRequest.
	 *
	 * @param boolean $initCurrentRequest Initialize request info with that of the current
	 * client request being handled (optional, default=true)
	 */
	public function __construct($initCurrentRequest = true) {
		parent::__construct($initCurrentRequest);
	}

	/**
	 * Setter for URI pattern
	 *
	 * @param string $pattern A regular expression pattern that mathes this request URI
	 *
	 * @return object $this for chaining support...
	 */
	public function setPattern($pattern) {
		$this->uriPattern = $pattern;
		return $this;
	}

	/**
	 * Getter for URI pattern
	 *
	 * @return string The regular expression pattern found that matches this request URI
	 */
	public function getPattern() {
		return $this->uriPattern;
	}

	/**
	 * Setter for URI params
	 *
	 * @param array $params An associative array with name/value URI parameter pairs
	 *
	 * @return object $this for chaining support...
	 */
	public function setParams($params) {
		$this->uriParams = $params;
		return $this;
	}

	/**
	 * Getter for URI params
	 *
	 * @return array An associative array with name/value URI parameter pairs
	 */
	public function getParams() {
		return $this->params;
	}
}

