<?php
/**
 * PHPGoodies:Headers - A collection manager for request headers
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Data.Hash');

/**
 * Headers
 */
class Headers extends Hash {

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
			if (('HTTP' == $name) || ('HTTPS' == $name)) {
				header("{$name} {$value}", true, $value);
				$this->del($name);
			}
		}

		// All other headers; order is unimportant
		foreach ($this->hash as $name => $value) {
			header("{$name}: {$value}");
		}

		$this->headersSent = true;
	}
}

