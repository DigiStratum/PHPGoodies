<?php
/**
 * PHPGoodies:Lib_Net_Api_Rest_JsonApi_Server_Uri - JSON:API Class for accessing URI components
 *
 * @uses Lib_Data_Hash
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Data.Hash');

/**
 * JSON:API Class for accessing URI components
 */
class Lib_Net_Api_Rest_JsonApi_Server_Uri extends Lib_Data_Hash {

	/**
	 * The URI that we are working with
	 */
	protected $uri;

	/**
	 * Constructor
	 *
	 * @param string $uri The URI that we are working with
	 */
	public function __construct(string $uri = null) {
		$this->uri = $uri;
	}

	/**
	 * 
	 */
	public function toString(Lib_Net_Api_Rest_JsonApi_Server_Uri_Pattern $pattern) {
		// TODO: use the Pattern class to take hashed components and turn them into a Uri string
	}

	public function fromString(Lib_Net_Api_Rest_JsonApi_Server_Uri_Pattern $pattern) {
		// TODO: use the Pattern to decompose $this->uri into components
	}
}
	
