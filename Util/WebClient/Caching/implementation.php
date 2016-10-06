<?php
/**
 * PHPGoodies:Util_WebClient_Caching - A caching layer on top of WebClient (WORK IN PROGRESS)
 *
 * @uses Util_WebClient
 * @uses Lib_Data_Validators
 * @uses Lib_Net_Url
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Util.WebClient');
PHPGoodies::import('Lib.Data.Validators');
PHPGoodies::import('Lib.Net.Url');

/**
 * WebClient - A layer on top of CURL to simulate browser behavior
 */
class Util_WebClient_Caching extends Util_WebClient {

	/**
	 *
	 */
	protected $initialized;

	/**
	 *
	 */
	protected $cacheDir;

	/**
	 * IOWrapper instance
	 */
	protected $iow;

	/**
	 * Constructor
	 *
	 * @param string $cacheDir Directory to use for cached requests
	 * @param object $IOWrapper Instance of IOWrapper class
	 */
	public function __construct($cacheDir, $IOWrapper) {
		// @fixme iswritabledirectory whoild be in IOW, not validators
		if (! Validators::isWritableDirectory($cacheDir)) {
			throw new \InvalidArgumentException("Supplied cacheDir [{$cacheDir}] is not a writable directory");
		}
		$this->cacheDir = $cacheDir;
		$this->iow = $IOWrapper;
	}

        /**
	 * Perform a GET request to the specified URL
	 *
	 * @todo Make some sort of cache expiration timeframe (data inside the cache? file datetime?)
	 *
	 * @param string $url A complete URL to fetch
	 * @param boolean $useCache defaults to true to read through cache, false to bypass
	 *
	 * @return Response from the URL or null on error
	 */
	public function get($url, $useCache = true) {
		if ($useCache) {
			// Hash the URL
			$hash = md5($url);

			// Get the URL's hostname
			$u = PHPGoodies::instantiate('Lib.Net.Url', $url);
			$host = $u->getHost();

			// Figure our cache file
			$cacheFile = join(
				DIRECTORY_SEPARATOR,
				array($this->cacheDir, $host, "{$hash}.json")
			);

			// If the cache file exists already...
			if ($this->iow->isFile($cacheFile)) {
				// @todo Deliver a response decoded from the JSON in this file
			}
		}

		$res = parent::get($url);
		if ($useCache) {
			// @todo Store the response encoded as JSON into the cache file
		}

		return $res;
	}
}

