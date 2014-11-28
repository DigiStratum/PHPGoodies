<?php
/**
 * PHPGoodies:HttpHeaders - A collection manager for request/response headers
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Data.Hash');

/**
 * HttpHeaders
 */
class HttpHeaders extends Hash {

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
			if (strpos($name, 'HTTP')  === 0) {

				// Send it only for now...
				header("{$name} {$value}", true, $value);
				break;
			}
		}

		// All other headers; order is unimportant
		foreach ($this->hash as $name => $value) {

			// If it is the HTTP/S header, it's already been sent
			if (strpos($name, 'HTTP')  === 0) continue;

			// Send this one proper-like
			header("{$this->properName($name)}: {$value}");
		}

		$this->headersSent = true;
	}

	/**
	 * Receive all the headers in the current request being serviced
	 *
	 * @todo supply some alternative to emmulate this for testing outside httpd context?
	 */
	public function receive() {

		// This function only exists under an Apache/httpd context...
		if (function_exists('getallheaders')) {
			$headers = getallheaders();
			foreach ($headers as $name => $value) {
				$this->set($this->properName($name), $value);
			}
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
		return parent::get($this->properName($name));
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
		parent::set($this->properName($name), $value);
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
		parent::del($this->properName($name));
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
		return parent::has($this->properName($name));
	}

	/**
	 * Make the supplied name "proper" with respect to capitalization
	 *
	 * @param string $name The header name that we want to make proper
	 *
	 * @return string The proper representation of the supplied name
	 */
	protected function properName($name) {
		$parts = explode('-', $name);
		foreach ($parts as $pos => $part) $parts[$pos] = ucfirst(strtolower($part));
		return implode('-', $parts);
	}
}

