<?php
/**
 * PHPGoodies:Lib_Net_Http_Request - Objectify a pile of information about a request
 *
 * @uses Lib_Data_Hash
 * @uses Lib_Net_Http_Headers
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * HTTP HttpRequest
 */
class Lib_Net_Http_Request {

	/**
	 * HTTP Request methods
	 */
	const HTTP_DELETE	= 'DELETE';
	const HTTP_GET		= 'GET';
	const HTTP_HEAD		= 'HEAD';
	const HTTP_OPTIONS	= 'OPTIONS';
	const HTTP_POST		= 'POST';
	const HTTP_PATCH	= 'PATCH';
	const HTTP_PUT		= 'PUT';
	const HTTP_TRACE	= 'TRACE';

	protected $readonly = false;

	/**
	 * Request Properties
	 *
	 * preFragment=false -> scheme://host[:port]/path[?queryString][#fragment]
	 * preFragment=true  -> scheme://host[:port]/path[#fragment][?queryString]
	 */
	protected $scheme;	// HTTP/S
	protected $host;	// www.yoursite.com
	protected $port;	// service port (80|443)
	protected $path;
	protected $queryString;
	protected $fragment;
	
	protected $method;	// One of the defined HTTP_* request methods
	protected $isTunnelled;	// true|false to tunnel methods other than GET|POST
	protected $preFragment;	// true|false to preFragment a request being formed
	protected $payload;	// All the name=value pair data for GET|POST, etc.
	protected $rawPayload;	// Raw POST/PUT/PATCH data if it is not form-encoded
	protected $headers;	// HttpHeaders instance with the complete set

	/**
	 * Constructor
	 *
	 * Note: pass false for the initCurrentRequest initializer if you want to make your own new
	 * HttpRequest.
	 *
	 * @param boolean $initCurrentRequest Initialize request info with that of the current
	 * client request being handled (optional, default=true)
	 */
	public function __construct($initCurrentRequest = true) {

		$this->reset();

		if ($initCurrentRequest) {

			// If it doesn't look like we're running in an HTTP context, do nothing
			if (! isset($_SERVER['HTTP_HOST'])) return;

			// Request Method
			if (isset($_SERVER['REQUEST_METHOD'])) {
				$method = $this->setMethod($_SERVER['REQUEST_METHOD']);

				// Support for method tunnelling
				if ((HTTP_POST == $method) && isset($_SERVER['HTTP_X_HTTP_METHOD'])) {
					switch ($_SERVER['HTTP_X_HTTP_METHOD']) {
						case HTTP_DELETE:
						case HTTP_PUT:
							$this->setMethod($_SERVER['HTTP_X_HTTP_METHOD']);
							$this->setIsTunnelled(true);
							break;
						default:
							throw new Exception("Unexpected value for HTTP_X_HTTP_METHOD Header: '{$_SERVER['HTTP_X_HTTP_METHOD']}'");
					}
				}
				else $this->setIsTunnelled(false);
			}

			// Scheme
			$isSecure = false;
			// ref : http://stackoverflow.com/questions/1175096/how-to-find-out-if-you-are-using-https-without-serverhttps
			if (
				// Check the obvious
				(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']) ||
				// For load balancers/proxies that obscure this...
				(isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && ('https' == $_SERVER['HTTP_X_FORWARDED_PROTO'])) ||
				(isset($_SERVER['HTTP_X_FORWARDED_SSL']) && ('on' == $_SERVER['HTTP_X_FORWARDED_SSL'])) ||
				// See if any of the HTTPS-specific headers are lit up
				(isset($_SERVER['HTTPS_KEYSIZE'])) ||
				// Last chance to check the default SSL port (may be a lie, but if it is, it's a good lie!)
				(isset($_SERVER['SERVER_PORT']) && (443 == $_SERVER['SERVER_PORT']))) {
				$isSecure = true;
			}
			$this->setScheme($_SERVER['REQUEST_SCHEME'] . ($isSecure ? 'S' : ''));

			// Host
			$this->setHost($_SERVER['HTTP_HOST']);

			// Port
			$this->setPort($_SERVER['SERVER_PORT']);

			// URI Path
			$path = '';
			if (isset($_SERVER['REQUEST_URI'])) {
				$parts = explode('?', $_SERVER['REQUEST_URI']);
				$path = $parts[0];
			}
			else if (isset($_SERVER['PHP_SELF'])) {
				$path = $_SERVER['PHP_SELF'];
			}
			else if (isset($_SERVER['SCRIPT_NAME']) && isset($_SERVER['PATH_INFO'])) {
				$path = $_SERVER['SCRIPT_NAME'] . $_SERVER['PATH_INFO'];
			}
			$this->setPath($path);

			// Request data
			if (is_array($_REQUEST) && count($_REQUEST)) {
				foreach ($_REQUEST as $name => $value) {
					$this->setPayloadData($name, $value);
				}
			}
			else if (($this->getMethod() == 'POST') || ($this->getMethod() == 'PUT') || ($this->getMethod() == 'PATCH')) {
				// Capture the raw HTTP POST/PUT/PATCH data if there's no structured REQUEST data
				$this->setRawPayload($HTTP_RAW_POST_DATA);
			}

			// Headers
			$this->headers = PHPGoodies::instantiate('Lib.Net.Http.Headers');
			$this->headers->receive();

			$this->readonly = true;
		}
	}

	/**
	 * Reset the entire data structure
	 *
	 * @return object $this for chainable support...
	 */
	public function reset() {

		// We'll only do the reset if we're not readonly
		if ($this->readonly) throw new \Exception("Attempt to modify a read-only, preinitialized request");

		$this->scheme = null;
		$this->host = null;
		$this->port = null;
		$this->path = null;
		$this->queryString = null;
		$this->fragment = null;

		$this->method = null;
		$this->isTunnelled = null;
		$this->payload = null;
		$this->rawPayload = null;
		$this->preFragment = null;
		$this->headers = null;

		return $this;
	}

	/**
	 * Gets the current payload as a formatted query string if possible
	 *
	 * @return string URL-encoded query string with the data (may be 0-length if no data)
	 */
	public function getDataAsQueryString() {
		PHPGoodies::import('Lib.Net.Http.QueryString');
		return QueryString::getDataAsQueryString($this->payload);
	}



	/**
	 * Getter for the request scheme
	 *
	 * @return string scheme identifier (HTTP/S)
	 */
	public function getScheme() {
		return $this->scheme;
	}

	/**
	 * Getter for the request host
	 *
	 * @return string hostname (www.yoursite.com)
	 */
	public function getHost() {
		return $this->host;
	}

	/**
	 * Getter for the request port
	 *
	 * @return integer port, if any
	 */
	public function getPort() {
		return $this->port;
	}

	/**
	 * Getter for the request URI path
	 *
	 * @return string URI path for the request, if any
	 */
	public function getPath() {
		return $this->path;
	}

	/**
	 * Getter for the request URL query string
	 *
	 * @return string URL query string for the request, if any
	 */
	public function getQueryString() {
		return $this->queryString;
	}

	/**
	 * Getter for the request URL fragment
	 *
	 * @return string URL fragment for the request, if any
	 */
	public function getFragment() {
		return $this->fragment;
	}










	/**
	 * Setter for request scheme
	 *
	 * @param string $scheme Something like HTTP/S normally, but could be another
	 *
	 * @return object $this for chainable support...
	 */
	public function setScheme($scheme) {
		// We'll only modify properties if we're not readonly
		if ($this->readonly) throw new \Exception("Attempt to modify a read-only, preinitialized request");
		Oop_Type::requireType($scheme, 'string');
		$this->scheme = strtoupper($scheme);
		return $this;
	}

	/**
	 * Setter for request host
	 *
	 * @param string $host www.yoursite.com
	 *
	 * @return object $this for chainable support...
	 */
	public function setHost($host) {
		// We'll only modify properties if we're not readonly
		if ($this->readonly) throw new \Exception("Attempt to modify a read-only, preinitialized request");
		Oop_Type::requireType($scheme, 'string');
		$this->host = $host;
		return $this;
	}

	/**
	 * Setter for request port
	 *
	 * @param integer $port Probably 80 or 443 for typical environments
	 *
	 * @return object $this for chainable support...
	 */
	public function setPort($port) {
		// We'll only modify properties if we're not readonly
		if ($this->readonly) throw new \Exception("Attempt to modify a read-only, preinitialized request");
		Oop_Type::requireType($scheme, 'number');
		$this->port = $port;
		return $this;
	}

	/**
	 * Setter for request URI Path
	 *
	 * @param string $path The URI for this request
	 *
	 * @return object $this for chainable support...
	 */
	public function setPath($path) {
		// We'll only modify properties if we're not readonly
		if ($this->readonly) throw new \Exception("Attempt to modify a read-only, preinitialized request");
		Oop_Type::requireType($scheme, 'string');
		$this->path = $path;
		return $this;
	}

	/**
	 * Setter for request query string
	 *
	 * @param string $queryString Url-encoded query string
	 *
	 * @return object $this for chainable support...
	 */
	public function setQueryString($queryString) {
		// We'll only modify properties if we're not readonly
		if ($this->readonly) throw new \Exception("Attempt to modify a read-only, preinitialized request");
		Oop_Type::requireType($scheme, 'string');
		$this->queryString = $queryString;
		return $this;
	}

	/**
	 * Setter for request document fragment (everything after the '#') in the URL
	 *
	 * @param string $fragment The fragment identifier
	 *
	 * @return object $this for chainable support...
	 */
	public function setFragment($fragment) {
		// We'll only modify properties if we're not readonly
		if ($this->readonly) throw new \Exception("Attempt to modify a read-only, preinitialized request");
		Oop_Type::requireType($scheme, 'string');
		$this->fragment = $fragment;
		return $this;
	}

	/**
	 * Setter for request method
	 *
	 * @param string $method One of the supported http methods (GET/POST/OPTIONS, etc)
	 *
	 * @return object $this for chainable support...
	 */
	public function setMethod($method) {
		// We'll only modify properties if we're not readonly
		if ($this->readonly) throw new \Exception("Attempt to modify a read-only, preinitialized request");
		if (! $this->isValidMethod($method)) {
			throw new \Exception("Attempt to set an invalid request method ({$method})");
		}
		$this->method = strtoupper($method);
		return $this;
	}

	/**
	 * Setter for request method tunnelled state
	 *
	 * @param boolean $isTunnelled true to tunnel real method through POST as HTTP_X_HTTP_METHOD
	 *
	 * @return object $this for chainable support...
	 */
	public function setIsTunnelled($isTunnelled) {
		// We'll only modify properties if we're not readonly
		if ($this->readonly) throw new \Exception("Attempt to modify a read-only, preinitialized request");
		Oop_Type::requireType($scheme, 'boolean');
		$this->isTunnelled = $isTunnelled ? true : false;
		return $this;
	}

	/**
	 * Setter for raw payload data
	 *
	 * Note: it only makes sense to use this OR setPayloadData - not both!
	 *
	 * @param string Raw POST/PUT/PATCH payload data
	 *
	 * @return object $this for chainable support...
	 */
	public function setRawPayload(&$payload) {
		// We'll only modify properties if we're not readonly
		if ($this->readonly) throw new \Exception("Attempt to modify a read-only, preinitialized request");
		Oop_Type::requireType($scheme, 'string');
		$this->rawPayload = $payload;
		return $this;
	}

	/**
	 * Setter for request data element(s)
	 *
	 * Note: it only makes sense to use this OR setRawPayload - not both!
	 *
	 * Note that value should really be a simple string or integer to make things easy to follow
	 * but it would technically be possibly to set an array of simple string/integer values as
	 * well. Supplying objects or any other data types here will not be rejected, but probably
	 * won't get you what you were hoping for...
	 *
	 * @param string $name Name of the data element to set
	 * @param mixed $value The value to set for this data element
	 *
	 * @return object $this for chainable support...
	 */
	public function setPayloadData($name, $value = null) {

		// We'll only modify properties if we're not readonly
		if ($this->readonly) throw new \Exception("Attempt to modify a read-only, preinitialized request");

		// If this is the first data element, initialize the array to hold data
		if (! is_array($this->payload)) $this->payload = PHPGoodies::instantiate('Lib.Data.Hash');

		// If this data element is not already in place, then we'll use a single value
		if (! isset($this->payload[$name])) {
			$this->payload->add($name, $value);
		}
		else {
			// Something is already in this data element - is it an array?
			$val = $this->payload->get($name);
			if (is_array($val)) {
				// Sweet - just add this value to the array
				$val[] = $value;
			}
			else {
				// Convert it to an array and make the current
				// value and the new one the first two elements
				$val = array(
					$this->payload->get($name),
					$value
				);
			}
			$this->payload->set($name, $val);
		}

		return $this;
	}

	/**
	 * Setter for pre-fragmenting the URL
	 *
	 * So "prefragment" is a made-up term here, but it refers to formulating an irregular URL
	 * by placing the fragment in front of the query string such as:
	 *
	 * scheme://host:port/path/#fragment/?querystring
	 *
	 * This is useful for applications that perform client-side routing such as with AngularJS.
	 *
	 * @param boolean $preFragment true if we want to prefreagment the URL ahead of querystring 
	 *
	 * @return object $this for chainable support...
	 */
	public function setPreFragment($preFragment) {
		// We'll only modify properties if we're not readonly
		if ($this->readonly) throw new \Exception("Attempt to modify a read-only, preinitialized request");
		$this->preFragment = $preFragment ? true : false;
		return $this;
	}







	/**
	 * Make sure the specified method is a valid one
	 */
	protected function isValidMethod($method) {
		Oop_Type::requireType($method, 'string');
		switch (strtoupper($method)) {
			case HTTP_DELETE:
			case HTTP_GET:
			case HTTP_HEAD:
			case HTTP_OPTIONS:
			case HTTP_POST:
			case HTTP_PATCH:
			case HTTP_PUT:
			case HTTP_TRACE:
				return true;
		}
		return false;
	}
}

