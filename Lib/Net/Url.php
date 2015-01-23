<?php
/**
 * PHPGoodies:Url - A class for URL manipulation
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Url - A class for URL manipulation
 */
class Url {

	/**
	 * Parts of the URL we are working with; 'domain' is required, everything else optional
	 */
	protected $urlParts = array();

	/**
	 * Constructor
	 */
	public function __construct($url = '') {
		$this->setUrl($url);
	}

	/**
	 * Initialize our properties with the provided URL
	 *
	 * @param string $url A well-formed URL string to parse
	 *
	 * @throws Exception if anything about the URL provided looks wrong/impossible
	 *
	 * @return object $this for chaining...
	 */
	public function setUrl($url) {

		// Get the basic URL parts that PHP is natively able to
		$urlParts = parse_url($url);

		// Make sure we got a good parse out of it
		if (false === $urlParts) {
			throw new \Exception('Failed to parse the supplied URL');
		}

		// Force scheme validity...
		if (isset($urlParts['scheme'])) {
			if (! $this->isValidScheme($urlParts['scheme'])) {
				throw new \Exception('URL was supplied with an invalid scheme');
			}
		}

		// Force hostname validity...
		if (! $this->isValidHost($urlParts['host'])) {
			throw new \Exception('URL was supplied with an invalid hostname');
		}

		// Force port validity
		if (isset($urlParts['port'])) {

			// Force the port to be an integer
			$urlParts['port'] = intval($urlParts['port']);
			if (! $this->isValidPort($urlParts['port'])) {
				throw new \Exception('URL was supplied with an invalid port specifier');
			}
		}

		// Move the final result
		$host = $urlParts['host'];
		unset($urlParts['host']);
		$this->urlParts = $urlParts;

		// Get rid of the original host; it will be reconstituted from the parts as needed
		$this->setHost($host);

		return $this;
	}

	/**
	 * Get the resulting URL from the current set of properties
	 *
	 * Most URL's are like this: scheme://user:pass@host:port/path?query#fragment
	 *
	 * HTML5 compatible URLS might be: scheme://user:pass@host:port/path#fragment?query
	 *
	 * Mail is an exception missing the //: mailto:user@host?query
	 *
	 * @param boolean $forHtml5 optionally swap the query/fragment parts (default = false)
	 *
	 * @return string A URL composed of all the parts as currently defined
	 */
	public function getUrl($forHtml5 = false) {
		$url = '';

		// scheme:
		$scheme = $this->getScheme();
		$url .= (is_null($scheme) ? 'http' : $scheme) . ':';
		if ('mailto' != $scheme) $url .= '//';

		// user:pass@
		$user = $this->getUser();
		$pass = $this->getPass();
		$url .= (is_null($user) ? '' : $user) . (is_null($pass) ? '' : ':' . $pass) . '@';

		// hostname
		$url .= $this->getHost();

		// port
		$port = $this->getPort();
		$url .= is_null($port) ? '' : ':' . $port;

		// path
		$path = $this->getPath();
		$url .= is_null($path) ? '/' : $path;

		// query & fragment
		$query = $this->getQuery();
		$fragment = $this->getFragment();

		if ($forHtml5) {

			// fragment
			$url .= is_null($fragment) ? '' : '#' . $fragment;

			// query
			$url .= is_null($query) ? '' : '?' . $query;
		}
		else {

			// query
			$url .= is_null($query) ? '' : '?' . $query;

			// fragment
			$url .= is_null($fragment) ? '' : '#' . $fragment;
		}

		return $url;
	}

	/**
	 * Check whether the hostname supplied looks like a valid one
	 *
	 * Note that we are not checking the DNS (or something else) resolves it to a real host
	 * which is accessible, only that the hostname looks like one that *could* resolve if
	 * queried...
	 *
	 * @param string $host The hostname we want to examine
	 *
	 * @return boolean true if the hostname looks good, else false
	 */
	public function isValidHost($host) {

		// Make sure it's not an empty string
		$host = trim(strtolower($host));
		if (! strlen($host)) return false;

		// Valid characters are a-z, 0-9, '-', and '.' - scrub them!
		$remaining = preg_replace('/[a-z0-9-\.]/', '', $host);

		// If any characters are remaining, they are invalid, so...
		return strlen($remaining) ? false : true;
	}

	/**
	 * Check whether the TLD supplied matches a list of known valid ones
	 *
	 * @param string $tld The TLD that we want to validate
	 *
	 * @return boolean true if the TLD IS in fact a valid TLD, else false
	 */
	public function isValidTld($tld) {
		$tld = strtolower($tld);
		switch ($tld{0}) {
			case 'a':
			case 'b':
				$validTlds = array(
					'abogado', 'ac', 'academy', 'accountants', 'active',
					'actor', 'ad', 'adult', 'ae', 'aero', 'af', 'ag', 'agency',
					'ai', 'airforce', 'al', 'allfinanz', 'alsace', 'am',
					'amsterdam', 'an', 'android', 'ao', 'aq', 'aquarelle', 'ar',
					'archi', 'army', 'arpa', 'as', 'asia', 'associates', 'at',
					'attorney', 'au', 'auction', 'audio', 'autos', 'aw', 'ax',
					'axa', 'az', 'ba', 'band', 'bank', 'bar', 'bargains',
					'bayern', 'bb', 'bd', 'be', 'beer', 'berlin', 'best', 'bf',
					'bg', 'bh', 'bi', 'bid', 'bike', 'bio', 'biz', 'bj', 'bl',
					'black', 'blackfriday', 'bloomberg', 'blue', 'bm', 'bmw',
					'bn', 'bnpparibas', 'bo', 'boo', 'boutique', 'bq', 'br',
					'brussels', 'bs', 'bt', 'budapest', 'build', 'builders',
					'business', 'buzz', 'bv', 'bw', 'by', 'bz', 'bzh'
				);
				break;

			case 'c':
			case 'd':
				$validTlds = array(
					'ca', 'cab', 'cal', 'camera', 'camp', 'cancerresearch',
					'capetown', 'capital', 'caravan', 'cards', 'care', 'career',
					'careers', 'cartier', 'casa', 'cash', 'cat', 'catering',
					'cc', 'cd', 'center', 'ceo', 'cern', 'cf', 'cg', 'ch',
					'channel', 'cheap', 'christmas', 'chrome', 'church', 'ci',
					'citic', 'city', 'ck', 'cl', 'claims', 'cleaning', 'click',
					'clinic', 'clothing', 'club', 'cm', 'cn', 'co', 'coach',
					'codes', 'coffee', 'college', 'cologne', 'com', 'community',
					'company', 'computer', 'condos', 'construction',
					'consulting', 'contractors', 'cooking', 'cool', 'coop',
					'country', 'cr', 'credit', 'creditcard', 'cricket', 'crs',
					'cruises', 'cu', 'cuisinella', 'cv', 'cw', 'cx', 'cy',
					'cymru', 'cz', 'dad', 'dance', 'dating', 'day', 'de',
					'deals', 'degree', 'delivery', 'democrat', 'dental',
					'dentist', 'desi', 'dev', 'diamonds', 'diet', 'digital',
					'direct', 'directory', 'discount', 'dj', 'dk', 'dm', 'dnp',
					'do', 'docs', 'domains', 'doosan', 'durban', 'dvag', 'dz'
				);
				break;

			case 'e':
			case 'f':
				$validTlds = array(
					'eat', 'ec', 'edu', 'education', 'ee', 'eg', 'eh', 'email',
					'emerck', 'energy', 'engineer', 'engineering', 'enterprises',
					'equipment', 'er', 'es', 'esq', 'estate', 'et', 'eu',
					'eurovision', 'eus', 'events', 'everbank', 'exchange',
					'expert', 'exposed', 'fail', 'farm', 'fashion', 'feedback',
					'fi', 'finance', 'financial', 'firmdale', 'fish', 'fishing',
					'fit', 'fitness', 'fj', 'fk', 'flights', 'florist', 'flowers',
					'flsmidth', 'fly', 'fm', 'fo', 'foo', 'forsale', 'foundation',
					'fr', 'frl', 'frogans', 'fund', 'furniture', 'futbol'
				);
				break;

			case 'g':
			case 'h':
				$validTlds = array(
					'ga', 'gal', 'gallery', 'garden', 'gb', 'gbiz', 'gd', 'ge',
					'gent', 'gf', 'gg', 'ggee', 'gh', 'gi', 'gift', 'gifts',
					'gives', 'gl', 'glass', 'gle', 'global', 'globo', 'gm',
					'gmail', 'gmo', 'gmx', 'gn', 'google', 'gop', 'gov', 'gp',
					'gq', 'gr', 'graphics', 'gratis', 'green', 'gripe', 'gs',
					'gt', 'gu', 'guide', 'guitars', 'guru', 'gw', 'gy',
					'hamburg', 'haus', 'healthcare', 'help', 'here', 'hiphop',
					'hiv', 'hk', 'hm', 'hn', 'holdings', 'holiday', 'homes',
					'horse', 'host', 'hosting', 'house', 'how', 'hr', 'ht', 'hu'
				);
				break;

			case 'i':
			case 'j':
				$validTlds = array(
					'ibm', 'id', 'ie', 'il', 'im', 'immo', 'immobilien', 'in',
					'industries', 'info', 'ing', 'ink', 'institute', 'insure',
					'int', 'international', 'investments', 'io', 'iq', 'ir',
					'irish', 'is', 'it', 'iwc', 'je', 'jetzt', 'jm', 'jo',
					'jobs', 'joburg', 'jp', 'juegos'
				);
				break;

			case 'k':
			case 'l':
				$validTlds = array(
					'kaufen', 'kddi', 'ke', 'kg', 'kh', 'ki', 'kim', 'kitchen',
					'kiwi', 'km', 'kn', 'koeln', 'kp', 'kr', 'krd', 'kred', 'kw',
					'ky', 'kz', 'la', 'lacaixa', 'land', 'lat', 'latrobe',
					'lawyer', 'lb', 'lc', 'lds', 'lease', 'legal', 'lgbt', 'li',
					'lidl', 'life', 'lighting', 'limited', 'limo', 'link', 'lk',
					'loans', 'london', 'lotte', 'lotto', 'lr', 'ls', 'lt',
					'ltda', 'lu', 'luxe', 'luxury', 'lv', 'ly'
				);
				break;

			case 'm':
			case 'n':
				$validTlds = array(
					'ma', 'madrid', 'maison', 'management', 'mango', 'market',
					'marketing', 'marriott', 'mc', 'md', 'me', 'media', 'meet',
					'melbourne', 'meme', 'memorial', 'menu', 'mf', 'mg', 'mh',
					'miami', 'mil', 'mini', 'mk', 'ml', 'mm', 'mn', 'mo', 'mobi',
					'moda', 'moe', 'monash', 'money', 'mormon', 'mortgage',
					'moscow', 'motorcycles', 'mov', 'mp', 'mq', 'mr', 'ms', 'mt',
					'mu', 'museum', 'mv', 'mw', 'mx', 'my', 'mz', 'na', 'nagoya',
					'name', 'navy', 'nc', 'ne', 'net', 'network', 'neustar',
					'new', 'nexus', 'nf', 'ng', 'ngo', 'nhk', 'ni', 'ninja',
					'nl', 'no', 'np', 'nr', 'nra', 'nrw', 'nu', 'nyc', 'nz'
				);
				break;

			case 'o':
			case 'p':
				$validTlds = array(	
					'okinawa', 'om', 'one', 'ong', 'onl', 'ooo', 'org',
					'organic', 'osaka', 'otsuka', 'ovh', 'pa', 'paris',
					'partners', 'parts', 'party', 'pe', 'pf', 'pg', 'ph',
					'pharmacy', 'photo', 'photography', 'photos', 'physio',
					'pics', 'pictures', 'pink', 'pizza', 'pk', 'pl', 'place',
					'plumbing', 'pm', 'pn', 'pohl', 'poker', 'porn', 'post',
					'pr', 'praxi', 'press', 'pro', 'prod', 'productions', 'prof',
					'properties', 'property', 'ps', 'pt', 'pub', 'pw', 'py'
				);
				break;

			case 'q':
			case 'r':
				$validTlds = array(
					'qa', 'qpon', 'quebec', 're', 'realtor', 'recipes', 'red',
					'rehab', 'reise', 'reisen', 'reit', 'ren', 'rentals',
					'repair', 'report', 'republican', 'rest', 'restaurant',
					'reviews', 'rich', 'rio', 'rip', 'ro', 'rocks', 'rodeo',
					'rs', 'rsvp', 'ru', 'ruhr', 'rw', 'ryukyu'
				);
				break;

			case 's':
			case 't':
				$validTlds = array(
					'sa', 'saarland', 'sale', 'samsung', 'sarl', 'sb', 'sc',
					'sca', 'scb', 'schmidt', 'schule', 'schwarz', 'science',
					'scot', 'sd', 'se', 'services', 'sew', 'sexy', 'sg', 'sh',
					'shiksha', 'shoes', 'shriram', 'si', 'singles', 'sj', 'sk',
					'sky', 'sl', 'sm', 'sn', 'so', 'social', 'software',
					'sohu', 'solar', 'solutions', 'soy', 'space', 'spiegel',
					'sr', 'ss', 'st', 'su', 'supplies', 'supply', 'support',
					'surf', 'surgery', 'suzuki', 'sv', 'sx', 'sy', 'sydney',
					'systems', 'sz', 'taipei', 'tatar', 'tattoo', 'tax', 'tc',
					'td', 'technology', 'tel', 'tf', 'tg', 'th', 'tienda',
					'tips', 'tires', 'tirol', 'tj', 'tk', 'tl', 'tm', 'tn',
					'to', 'today', 'tokyo', 'tools', 'top', 'town', 'toys',
					'tp', 'tr', 'trade', 'training', 'travel', 'trust', 'tt',
					'tui', 'tv', 'tw', 'tz'
				);
				break;
			
			case 'u':
			case 'v':
				$validTlds = array(
					'ua', 'ug', 'uk', 'um', 'university', 'uno', 'uol', 'us',
					'uy', 'uz', 'va', 'vacations', 'vc', 've', 'vegas',
					'ventures', 'versicherung', 'vet', 'vg', 'vi', 'viajes',
					'video', 'villas', 'vision', 'vlaanderen', 'vn', 'vodka',
					'vote', 'voting', 'voto', 'voyage', 'vu'
				);
				break;

			case 'w':
			case 'x':
			case 'y':
			case 'z':
				$validTlds = array(
					'wales', 'wang', 'watch', 'webcam', 'website', 'wed',
					'wedding', 'wf', 'whoswho', 'wien', 'wiki', 'williamhill',
					'wme', 'work', 'works', 'world', 'ws', 'wtc', 'wtf', 'xxx',
					'xyz', 'yachts', 'yandex', 'ye', 'yoga', 'yokohama',
					'youtube', 'yt', 'za', 'zip', 'zm', 'zone', 'zuerich', 'zw'
				);
				break;
		}

		return in_array($tld, $validTlds);
	}

	/**
	 * Check whether the scheme supplied is a valid IANA registered schemes
	 *
	 * ref: http://en.wikipedia.org/wiki/URI_scheme
	 *
	 * @param string $scheme The scheme that we want to validate
	 *
	 * @return boolean true if the scheme IS a valid one, else false
	 */
	public function isValidScheme($scheme) {

		// Permanent schemes...
		$permanentSchemes = array(
			'aaa', 'aaas', 'about', 'acap', 'acct', 'cid', 'coap', 'coaps', 'crid',
			'data', 'dav', 'dict', 'dns', 'file', 'ftp', 'geo', 'go', 'gopher',
			'h323', 'http', 'https', 'iax', 'icap', 'im', 'imap', 'info', 'ipp', 'ipps',
			'iris', 'iris.beep', 'iris.xpc', 'iris.xpcs', 'iris.lws', 'jabber', 'ldap',
			'mailto', 'mid', 'msrp', 'msrps', 'mtqp', 'mupdate', 'news', 'nfs', 'ni',
			'nih', 'nntp', 'opaquelocktoken', 'pop', 'pres', 'reload', 'rstp',
			'service', 'session', 'shttp', 'sieve', 'sip', 'sips', 'sms', 'snmp',
			'soap.beep', 'soap.beeps', 'stun', 'stuns', 'tag', 'tel', 'telnet', 'tftp',
			'thismessage', 'tn3270', 'tip', 'turn', 'turns', 'tv', 'urn', 'vemmi', 'ws',
			'wss', 'xcon', 'xcon-userid', 'xmlrpc.beep', 'xmlrpc.beeps', 'xmpp',
			'z39.50r', 'z39.50s'
		);

		if (in_array($scheme, $permanentSchemes)) return true;

		// Provisional schemes (subject to change, or possible promotion to permanent)
		$provisionalSchemes = array(
			'acr', 'adiumxtra', 'afp', 'afs', 'aim', 'app', 'apt', 'attachment', 'aw',
			'barion', 'beshare', 'bitcoin', 'bolo', 'callto', 'chrome',
			'chrome-extension', 'com-eventbrite-attendee', 'content', 'cvs',
			'dlna-playsingle', 'dlna-playcontainer', 'dtn', 'dvb', 'ed2k', 'facetime',
			'feed', 'finger', 'fish', 'gg', 'git', 'gizmoproject', 'gtalk', 'hcp',
			'icon', 'ipn', 'irc', 'irc6', 'ircs', 'itms', 'jar', 'jms', 'keyparc',
			'lastfm', 'ldaps', 'magnet', 'maps', 'market', 'message', 'mms', 'ms-help',
			'ms-settings-power', 'msnim', 'mumble', 'mvn', 'notes', 'oid', 'palm',
			'paparazzi', 'pkcs11', 'platform', 'proxy', 'psyc', 'query', 'res',
			'resource', 'rmi', 'rsync', 'rtmfp', 'rtmp', 'secondlife', 'sftp', 'sgn',
			'skype', 'smb', 'soldat', 'spotify', 'ssh', 'steam', 'svn', 'teamspeak',
			'things', 'udp', 'unreal', 'ut2004', 'ventrilo', 'view-source', 'webcal',
			'wtai', 'wyciwyg', 'xfire', 'xri', 'ymsgr'
		);

		if (in_array($scheme, $provisionalSchemes)) return true;

		// Historical schemes (less likely to be used
		$historicalSchemes = array(
			'fax', 'mailserver', 'modem', 'pack', 'prospero', 'snews', 'videotex',
			'wais', 'z39.50'
		);

		if (in_array($scheme, $historicalSchemes)) return true;

		return false;
	}

	/**
	 * Check whether the port is a valid one
	 *
	 * @param integer $port The port that we want to check out
	 *
	 * @return boolean true if the portl looks ok to use, else false
	 */
	public function isValidPort($port) {

		// Get an integer version of the port
		$tport = intval($port);

		// Then make sure the supplied port still looks like it and it is in range
		if (("{$port}" !== "{$tport}") || ($tport < 1) || ($tport > 65535)) {
			return false;
		}

		return true;
	}

	/**
	 * Gets the URL scheme
	 *
	 * @return string The currently set scheme or null if none is set
	 */
	public function getScheme() {
		return isset($this->urlParts['scheme']) ? $this->urlParts['scheme'] : null;
	}

	/**
	 * Set the URL scheme
	 *
	 * @param string $scheme the scheme we want to set to
	 *
	 * @throws Exception if the provided scheme is not valid
	 *
	 * @return object $this for chaining...
	 */
	public function setScheme($scheme) {
		if (! $this->isValidScheme($scheme)) {
			throw new \Exception("Attempted to set an invalid scheme ('{$scheme}')");
		}

		$this->urlParts['scheme'] = $scheme;

		return $this;
	}

	/**
	 * Get the assembled host (from subdomain.domain.tld)
	 *
	 * @return string The hostname assembled from subdomain, domain, and tld parts
	 */
	public function getHost() {

		// subdomain is conditionally available
		$subdomain = $this->getSubdomain();
		$host = is_null($subdomain) ? '' : $subdomain . '.';

		// domain is always available
		$host .= $this->getDomain();

		// host is conditionally available
		$tld = $this->getTld();
		$host .= is_null($tld) ? '' : '.' . $tld;

		return $host;
	}

	/**
	 * Set the host (and disassemble into subdomain.domain.tld components)
	 *
	 * @param string $host The hostname we want to set
	 *
	 * @return object $this for chaining...
	 */
	public function setHost($host) {

		// Break the host part into subdomain, domain, and tld parts
		if (strpos($host, '.') !== false) {

			// As the hostname component of a URL is not case sensitive, we'll go lcase
			$hostParts = explode('.', strtolower($host));

			// We know we've got at least 2 host parts since one '.' makes 2 parts...
			$last = count($hostParts) - 1;

			// A possible Compound TLD (e.g. '.co.uk') is the last 2 parts
			$possibleCompoundTld = $hostParts[$last - 1] . '.' . $hostParts[$last];

			// Otherwise a possible single-part TLD is just the last part
			$possibleTld = $hostParts[$last];

			// Now if the possible compound TLD is legitimate, then it wins...
			if ($this->isValidTld($possibleCompoundTld) && ($last >= 2)) {

				// The possibleCompoundTld will be TLD, the part before
				// it domain, and everything before that the subdomain
				$this->urlParts['tld'] = $possibleCompoundTld;
				array_pop($hostParts);
				array_pop($hostParts);
				$this->urlParts['domain'] = array_pop($hostParts);
				if (count($hostParts)) {
					$this->urlParts['subdomain'] = join('.', $hostParts);
				}
			}
			// Otherwise if the possible TLD is legitimate, then it wins...
			else if ($this->isValidTld($possibleCompoundTld) && ($last >= 1)) {

				// The possibleTld will be TLD, the part before it
				// domain, and everything before that the subdomain
				$this->urlParts['tld'] = $possibleCompoundTld;
				array_pop($hostParts);
				$this->urlParts['domain'] = array_pop($hostParts);
				if (count($hostParts)) {
					$this->urlParts['subdomain'] = join('.', $hostParts);
				}
			}
			// Otherwise there will be no TLD...
			else {

				// The last part will be domain and all others will be subdomain
				// (unless it is an IP address... in which case domain is the IP)
				$this->urlParts['domain'] = array_pop($hostParts);
				if (count($hostParts)) {
					$this->urlParts['subdomain'] = join('.', $hostParts);
				}
			}
		}
		else {
			// domain is the host and no TLD will be set
			$this->urlParts['domain'] = $host;
		}

		return $this;
	}

	/**
	 * Get the port
	 *
	 * @return integer port for the URL, or null if unspecified
	 */
	public function getPort() {
		return isset($this->urlParts['port']) ? $this->urlParts['port'] : null;
	}

	/**
	 * Set the port
	 *
	 * @param integer $port The port we want to set
	 *
	 * @throws Exception if the port is not valid
	 *
	 * @return object $this for chaining...
	 */
	public function setPort($port) {
		if (! $this->isValidPort($port)) {
			throw new \Exception("Attempted to set an invalid port ('{$port}')");
		}
		$this->urlParts['port'] = $port;
		return $this;
	}

	/**
	 * Get the user
	 *
	 * @return string user for the URL, or null if unspecified
	 */
	public function getUser() {
		return isset($this->urlParts['user']) ? $this->urlParts['user'] : null;
	}

	/**
	 * Set the user
	 *
	 * @param string $user The user we want to set
	 *
	 * @return object $this for chaining...
	 */
	public function setUser($user) {
		$this->urlParts['user'] = $user;
		return $this;
	}

	/**
	 * Get the password
	 *
	 * @return string password for the URL, or null if unspecified
	 */
	public function getPass() {
		return isset($this->urlParts['pass']) ? $this->urlParts['pass'] : null;
	}

	/**
	 * Set the password
	 *
	 * @param string $pass The password we want to set
	 *
	 * @return object $this for chaining
	 */
	public function setPass($pass) {
		$this->urlParts['pass'] = $pass;
		return $this;
	}

	/**
	 * Get the path
	 *
	 * @return string path for the URL, or null if unspecified
	 */
	public function getPath() {
		return isset($this->urlParts['path']) ? $this->urlParts['path'] : null;
	}

	/**
	 * Set the path
	 *
	 * @param string $path The path we want to set
	 *
	 * @return object $this for chaining...
	 */
	public function setPath($path) {
		$this->urlParts['path'] = $path;
		return $this;
	}

	/**
	 * Get the query
	 *
	 * @return string The query for the URL, or null if unspecified
	 */
	public function getQuery() {
		return isset($this->urlParts['query']) ? $this->urlParts['query'] : null;
	}

	/**
	 * Set the query
	 *
	 * @param string $query The query we want to set
	 *
	 * @return object $this for chaining...
	 */
	public function setQuery($query) {
		$this->urlParts['query'] = $query;
		return $this;
	}

	/**
	 * Get the fragment
	 *
	 * @return string The fragment for the URL, or null if unspecified
	 */
	public function getFragment() {
		return isset($this->urlParts['fragment']) ? $this->urlParts['fragment'] : null;
	}

	/**
	 * Set the fragment
	 *
	 * @param string $fragment The fragment we want to set
	 *
	 * @return object $this for chaining...
	 */
	public function setFragment($fragment) {
		$this->urlParts['fragment'] = $fragment;
		return $this;
	}

	/**
	 * Get the host subdomain component
	 *
	 * Note this can only be set by way of setting the host with setHost()
	 *
	 * @return string The subdomain component of the URL's host, or null if there isn't one
	 */
	public function getHostSubdomain() {
		return isset($this->urlParts['subdomain']) ? $this->urlParts['subdomain'] : null;
	}

	/**
	 * Get the host domain component
	 *
	 * Note this can only be set by way of setting the host with setHost(); This one is
	 * guaranteed/required to be set.
	 *
	 * @return string The domain component of the URL's host
	 */
	public function getHostDomain() {
		return $this->urlParts['domain'];
	}

	/**
	 * Get the host TLD component
	 *
	 * Get the host subdomain component
	 *
	 * @return string The TLD component of the URL's host, or null if there isn't one
	 */
	public function getHostTld() {
		return isset($this->urlParts['tld']) ? $this->urlParts['tld'] : null;
	}
}

