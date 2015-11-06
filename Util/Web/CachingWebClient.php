<?php
/**
 * PHPGoodies:CachingWebClient - A caching layer on top of WebClient (WORK IN PROGRESS)
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Util.Web.WebClient');
PHPGoodies::import('Lib.Data.Validators');

/**
 * WebClient - A layer on top of CURL to simulate browser behavior
 */
class CachingWebClient extends WebClient {

	/**
	 *
	 */
	protected $initialized;

	/**
	 *
	 */
	protected $cacheDir;

	/**
	 * Constructor
	 *
	 * @param string $cacheDir Directory to use for cached requests
	 *
	 */
	public function __construct($cacheDir) {
		if (! Validators::isWritableDirectory($cacheDir)) {
			throw new \InvalidArgumentException("Supplied cacheDir [{$cacheDir}] is not a writable directory");
		}
		$this->cacheDir = $cacheDir;
	}

        /**
	 * Perform a GET request to the specified URL
	 *
	 * @todo Put $useCache to work
	 *
	 * @param string $url A complete URL to fetch
	 * @param boolean $useCache defaults to true to read through cache, false to bypass
	 *
	 * @return Response from the URL or null on error
	 */
	public function get($url, $useCache = true) {
		return parent::get($url);
	}
}

