<?php
/**
 * PHPGoodies::Lib_Net_Http_Cookie_Collection - A collection of HttpCookies
 *
 * Cookies are organized by domain, then path, then name so that we can determine when the same
 * cookie is being updated, and which subset of the cookies to send for a given request. Every
 * cookie must have a domain, but path and name are optional. By default, domain comes from the
 * URL that was requested for which the cookie was returned. If the cookie itself has a domain
 * specified, it must be in the original domain... this can be tricky to detect if, for example,
 * the domain in the URL is something like www.mysite.co.uk - can the cookie should be able to
 * attach itself to www.mysite.co.uk or mysite.co.uk, but not co.uk or simply .uk - and certainly
 * not something partial like site.co.uk. We will need a list of TLD's to work with...
 *
 * TODO: See if we can use Lib.Data.Collection as a base class for this?
 *
 * @uses Lib_Net_Http_Cookie
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Http.Cookie');

/**
 * HttpCookie - A collection of HttpCookies
 */
class Lib_Net_Http_Cookie_Collection {

	/**
	 * An array that holds the collection of HttpCookies
	 */
	protected $httpCookies = array();

	/**
	 * Constructor
	 */
	public function __construct() {
	}

	/**
	 * Add an HttpCookie to the collection
	 *
	 * @param string URL that provides this cookie
	 * @param object HttpCookie instance
	 *
	 * @throws Exception if supplied param is not an instance of Lib_Net_Http_Cookie
	 *
	 * @return object $this for chaining...
	 */
	public function addCookie($url, $httpCookie) {

		// Make sure that what was provided is indeed an HttpCookie
		if (! $httpCookie instanceof Lib_Net_Http_Cookie) {
			throw new \Exception('Attempted to add something other than an HttpCookie to an HttpCookieCollection');
		}

		// If the cookie being added has a name...
		$name = $httpCookie->getName();
		if (! is_null($name)) {

			// See if there is already a cookie with the same name in the collection
			for ($xx = 0; $xx < count($this->httpCookies); $xx++) {

				// If the names match...
				if ($name === $this->httpCookies[$xx]->getName()) {

					// Superimpose the new cookie's properties onto the existing
					// one; this makes it possible to update an existing cookie
					// value without, for example, modifying it's expiry unless
					// explicitly instructed to do so...
					$value = $httpCookie->getValue();
					$this->httpCookies[$xx]->setValue("{$name}={$value}");
					$expires = $httpCookie->getExpires();
					if (! is_null($expires)) $this->httpCookies[$xx]->setExpires($expires);
					$domain = $httpCookie->getDomain();
					if (! is_null($domain)) $this->httpCookies[$xx]->setDomain($domain);
					$path = $httpCookie->getPath();
					if (! is_null($path)) $this->httpCookies[$xx]->setPath($path);
					$this->httpCookies[$xx]->setSecure($httpCookie->getSecure());
					$this->httpCookies[$xx]->setHttpOnly($httpCookie->getHttpOnly());
				}
			}
		}
		else {
			// Otherwise we'll just add this nameless cookie to the collection
			$this->httpCookies[] = $httpCookie;
		}

		return $this;
	}

	/**
	 * Clear all HttpCookies out of the collection
	 *
	 * @return object $this for chaining...
	 */
	public function clearCookies() {
		$this->httpCookies = array();
		return $this;
	}

	/**
	 * Format the collection of cookies into a value to pass in a "Cookie" request header
	 *
	 * @return string A value appropriate for a "Cookie" header (could be empty!)
	 */
	public function formatForRequestHeader() {
		$encoded = '';
		foreach ($this->httpCookies as $httpCookie) {
			$encoded .= strlen($encoded) ? '; ' : '';
			$encoded .= $httpCookie->formatForRequestHeader();
		}
		return $encoded;
	}
}

