<?php
/**
 * PHPGoodies:WebClient - A layer on top of CURL to simulate browser behavior
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * WebClient - A layer on top of CURL to simulate browser behavior
 */
class WebClient {

	const CLIENT_IE		= 'IE'; 
	const CLIENT_FF		= 'FF';
	const CLIENT_SAFARI	= 'AS';
	const CLIENT_CHROME	= 'GC';

	const OS_WIN_NT		= 'Windows NT';
	const OS_WIN_NT5	= 'Windows NT 5.1';
	const OS_WIN_NT6	= 'Windows NT 6.3';
	const OS_WIN_NT9	= 'Windows NT 9.0';

	const OS_WIN_98		= 'Windows 98';
	const OS_WIN_XP		= 'Windows XP';

	const OS_MAX_OSX	= 'Macintosh; U; PPC Mac OS X';
	const OS_MAC_OSX10	= 'Macintosh; U; Intel Mac OS X 10_9_3';
	const OS_MAC_IOS_IPAD	= 'iPad; CPU OS 6_0 like Mac OS X';

	const OS_LNX_X8664	= 'X11; Linux x86_64';

	/**
	 *
	 */
	protected $userAgent;

	/**
	 *
	 */
	protected $version;

	/**
	 *
	 */
	protected $response;

	/**
	 *
	 */
	public function __construct($client, $os, $version = null) {

		$this->response = PHPGoodies::instantiate('Lib.Net.Http.HttpResponse');

		// Figure out client specific settings (like user-agent)
		// ref: http://www.useragentstring.com/pages/useragentstring.php
		switch ($client) {

			case self::CLIENT_IE:

				// The latest from any given major version...
				$userAgents = array(
					'4' => "Mozilla/4.0 (compatible; MSIE 4.0; {$os}; )",
					'5' => "Mozilla/4.0 (compatible; MSIE 5.5;)",
					'6' => "Mozilla/4.0 (compatible; MSIE 6.1; {$os})",
					'7' => "Mozilla/5.0 (Windows; U; MSIE 7.0; {$os}; en-US)",
					'8' => "Mozilla/5.0 (compatible; MSIE 8.0; {$os}; SLCC1)",
					'9' => "Mozilla/5.0 (Windows; U; MSIE 9.0; {$os}; en-US)",
					'10' => "Mozilla/5.0 (compatible; MSIE 10.6; {$os}; Trident/5.0; InfoPath.2; SLCC1; ) 3gpp-gba UNTRUSTED/1.0",
					'11' => "Mozilla/5.0 (compatible, MSIE 11, {$os}; Trident/7.0;  rv:11.0) like Gecko"
				);

				break;

			case self::CLIENT_FF:
				$userAgents = array(
					'31' => "Mozilla/5.0 ({$os}; rv:31.0) Gecko/20100101 Firefox/31.0",
					'36' => "Mozilla/5.0 ({$os}; rv:36.0) Gecko/20100101 Firefox/36.0"
				);
				break;

			case self::CLIENT_SAFARI:

				// The latest from any given major version...
				$userAgents = array(
					'1' => "Mozilla/5.0 ({$os}; en-us) AppleWebKit/312.8 (KHTML, like Gecko) Safari/312.5",
					'2' => "Mozilla/5.0 ({$os}; en-us) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3",
					'3' => "Mozilla/5.0 ({$os}; en-us) AppleWebKit/530.1+ (KHTML, like Gecko) Version/3.2.1 Safari/525.27.1",
					'4' => "Mozilla/5.0 ({$os}; en-us) AppleWebKit/533.4 (KHTML, like Gecko) Version/4.1 Safari/533.4",
					'5' => "Mozilla/5.0 ({$os}; en-us) AppleWebKit/533.17.8 (KHTML, like Gecko) Version/5.0.1 Safari/533.17.8",
					'6' => "Mozilla/5.0 ({$os}) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A5355d Safari/8536.25",
					'7' => "Mozilla/5.0 ({$os}) AppleWebKit/537.75.14 (KHTML, like Gecko) Version/7.0.3 Safari/7046A194A"
				);
				break;

			case self::CLIENT_CHROME:
				$userAgents = array(
					'32' => "Mozilla/5.0 ({$os}) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1667.0 Safari/537.36",
					'33' => "Mozilla/5.0 ({$os}) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.517 Safari/537.36",
					'34' => "Mozilla/5.0 ({$os}) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1866.237 Safari/537.36",
					'35' => "Mozilla/5.0 ({$os}) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.3319.102 Safari/537.36",
					'36' => "Mozilla/5.0 ({$os}; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.67 Safari/537.36",
					'37' => "Mozilla/5.0 (Macintosh; {$os}) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36",
					'41' => "Mozilla/5.0 ({$os}) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36"
				);
				break;
		}

		$this->userAgent = isset($userAgents["{$version}"]) ? $userAgents["{$version}"] : $userAgents[count($userAgents) - 1];
	}

	/**
	 * Perform a GET request to the specified URL
	 */
	public function get($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_WRITEFUNCTION, array($this, 'bodyCallback'));
		curl_setopt($ch, CURLOPT_HEADERFUNCTION, array($this, 'headerCallback'));
		return curl_exec($ch) ? $this->response : null;
	}

	/**
	 * Callback function for each header of curl response
	 *
	 * @param resource $ch CURL handle
	 * @param string $data The response header received by CURL
	 *
	 * @return integer length of the data
	 */
	public function headerCallback($ch, $data) {
		$header = trim($data);
		if (strlen($header)) {

			$split = strpos($header, ':');
			if ($split !== false) {
				$name = trim(substr($header, 0, $split));
				$value = trim(substr($header, $split + 1));
			}
			else {
				$name = trim($header);
				$value = '';
			}
			$this->response->headers->set($name, $value);

			// Look for the status code from the first one
			if (1 == $this->response->headers->num()) {
				$parts = explode(' ', $name);
				if (count($parts) >=2) {
					$this->response->code = intval($parts[1]);
				}
			}
		}

		return strlen($data);
	}

	/**
	 * Callback function for body of curl response
	 *
	 * @param resource $ch CURL handle
	 * @param string $data The response body received by CURL
	 *
	 * @return integer length of the data
	 */
	public function bodyCallback($ch, $data) {
		$this->response->body = $data;
		return strlen($data);
	}
}

