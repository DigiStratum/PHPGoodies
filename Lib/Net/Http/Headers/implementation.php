<?php
/**
 * PHPGoodies:Lib_Net_Http_Headers - A collection manager for request/response headers
 *
 * @uses Lib_Data_Hash
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Data.Hash');

/**
 * HttpHeaders
 */
class Lib_Net_Http_Headers extends Lib_Data_Hash {

	/**
	 * Boolean flag for whether headers have already been sent
	 */
	protected $headersSent;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->headersSent = headers_sent();
	}

	/**
	 * Send all defined headers out to the client
	 */
	public function send() {

		// If headers have already been sent, there's nothing we can do now
		if ($this->headersSent) return;

		// See if we have an HTTP/S header which must be sent first
		foreach ($this->hash as $name => $value) {

			// If it is the HTTP/S headers...
			if (self::isHttp($name)) {

				// Send it only for now...
				header(self::properName($name) . ": {$value}", true, $value);
				break;
			}
		}

		// All other headers; order is unimportant
		foreach ($this->hash as $name => $value) {

			// If it is the HTTP/S header, it's already been sent
			if (self::isHttp($name)) continue;

			// Send this one proper-like
			header(self::properName($name) . ": {$value}");
		}

		$this->headersSent = true;
	}

	/**
	 * Receive all the headers in the current request being serviced
	 *
	 * Note: an alternative mechanism is provided to simulate request headers (for testing, or
	 * some other non-httpd-context operation) by supplying the array of headers just as httpd
	 * would supply it, but into the _SERVER['REQUEST_HEADERS'] super global instead. This is
	 * only permitted if we are not in a legitimate http context.
	 */
	public function receive() {

		// This function only exists under an Apache/httpd context...
		if (function_exists('getallheaders')) {
			$headers = getallheaders();
		}
		else if (isset($_SERVER['REQUEST_HEADERS'])) {
			$headers = $_SERVER['REQUEST_HEADERS'];
		}
		else $headers = array();

		foreach ($headers as $name => $value) {
			$this->set(self::properName($name), $value);
		}
	}

	/**
	 * properName wrapper for Hash::get()
	 *
	 * @param string $name Name of the header to get the value for
	 *
	 * @return string Whatever is currently stored in the named header
	 */
	public function get($name) {
		return parent::get(self::properName($name));
	}

	/**
	 * properName wrapper for Hash::set()
	 *
	 * @param string $name Name of the header to set the value for
	 * @param string $value The value we want to set the named header to
	 * 
	 * @return object $this for chaining support...
	 */
	public function set($name, $value) {
		parent::set(self::properName($name), $value);
		return $this;
	}

	/**
	 * properName wrapper for Hash::del()
	 *
	 * @param string $name Name of the header to delete the value for
	 * 
	 * @return object $this for chaining support...
	 */
	public function del($name) {
		parent::del(self::properName($name));
		return $this;
	}

	/**
	 * properName wrapper for Hash::has()
	 *
	 * @param string $name Name of the header to check the value of
	 *
	 * @return boolean true if we have this header set, else false
	 */
	public function has($name) {
		return parent::has(self::properName($name));
	}

	/**
	 * Is the supplied header name the special 'HTTP*' one?
	 *
	 * @param string $name The header name to check
	 *
	 * @return boolean true if it is an HTTP header, else false
	 */
	static public function isHttp($name) {
		return preg_match('/^http/i', $name);
	}

	/**
	 * Make the supplied name "proper" with respect to capitalization
	 *
	 * @param string $name The header name that we want to make proper
	 *
	 * @return string The proper representation of the supplied name
	 */
	static public function properName($name) {
		if (self::isHttp($name)) return strtoupper($name);
		$parts = explode('-', $name);
		foreach ($parts as $pos => $part) $parts[$pos] = ucfirst(strtolower($part));
		return implode('-', $parts);
	}
}

