<?php
/**
 * PHPGoodies:Domain - A class for domain/host name manipulation (WORK IN PROGRESS)
 *
 * There is enough work around this topic which is specialized to the purpose of working with
 * domain names, that it makes sense to break it off of the Url class and handle separately. The
 * reality is that there are plenty of cases for working with and accessing a host's services in
 * some way that there is no URL equivalent for, but the domain/hostname is still useful.
 *
 * A review of the list of TLD's and related second+ level domains found at the publicsuffix.org
 * reference link below reveals that aside from being quite extensive, the list appears to change
 * often enough that it would make this code difficult to maintain were all that information to be
 * hard-coded. Therefore we are going to shoot for a code-generator solution that actually pulls
 * the most recent data file and parses it into some generated PHP with data structures that are
 * well suited to looking up the top level domains and check-for and regenerate this file as needed.
 *
 * The initial driving force behind this implementation is to support HttpCookieCollection which
 * needs to be able to verify cookies issued by a remote server as being legitimately issued for a
 * valid domain, for our client to send the right set of cookies back for requests that match the
 * domain, and for our own server to be able to issue cookies and avoid issuing bad ones (even
 * though a well-behaved client will reject a bad cookie anyway - there's no sense in issuing a
 * cookie and expecting to see it turn up later if it's impossible for it to do so...)
 *
 * ref: https://publicsuffix.org/list/effective_tld_names.dat
 * ref: https://github.com/true/php-punycode
 * ref: http://php.net/manual/en/function.idn-to-ascii.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Http.HttpResponse');
PHPGoodies::import('Util.Web.WebClient');

/**
 * Domain - A class for domain/host name manipulation
 */
class Domain {

	/**
	 *
	 */
	public function __construct() {

		// See if our generated class is already in place
		$ri = PHPGoodies::resourceInfo('Generated.Lib.Net.DomainInfo');
		if (! file_exists($ri->path)) {
			$this->generateDomainInfo($ri);
		}
	}

	/**
	 * Generate the DomainInfo class with the provided Resource information
	 *
	 * @param object $resourceInfo An object with name and path properties for code generation
	 */
	protected function generateDomainInfo($resourceInfo) {

		// 1) Fetch the data file we will need to generate code from
		$url = 'https://publicsuffix.org/list/effective_tld_names.dat';
		$wc = PHPGoodies::instantiate('Util.Web.WebClient', WebClient::CLIENT_IE, WebClient::OS_WIN_NT6);
		$httpResponse = $wc->get($url);

		if (HttpResponse::HTTP_OK != $httpResponse->code) {
			throw new \Exception('Failed to retrieve data file generating DomainInfo');
		}

		// 2) Build a domain tree
		$domainTree = array();
		$line = strtok($httpResponse->body, "\n");
		$lineNum = 0;
		$domainSet = $ruleSet = array();
		$ruleSet['+'] = array();
		$ruleSet['-'] = array();
		while ($line !== false) {
			$line = trim($line);
			if (strlen($line)) {

				// Build a tree
				if (strpos($line, '//') === false) {
/*
					$lineNum++;
					$parts = array_reverse(explode('.', $line));

					// Add the parts into a tree
					$treeBranch =& $domainTree;
					while (count($parts)) {
						$part = array_shift($parts);

						// If this treeBranch isn't there...
						if (! isset($treeBranch[$part])) {

							// Make it!
							$treeBranch[$part] = array();
						}

						$treeBranch =& $treeBranch[$part];
					}
 */


					if ($line{0} == '*') {
						// Add to the positive rule set
						$ruleSet['+'][] = $line;
					}
					else if ($line{0} == '!') {
						// Add to the negative rule set
						$ruleSet['-'][] = $line;
					}
					else {

						// Add to a collection based on the string length
						$key = $line{0} . strlen($line);
						if (! isset($domainSet[$key])) {
							$domainSet[$key] = array();
						}
						$domainSet[$key][] = $line;
						}
					}

					// TODO: special accommodation needed for "*.tld" type patterns; what does it mean??
				}
				$line = strtok("\n");
			}

			// Sort the collection alphabetically
			$keys = array_keys($domainSet);
			foreach ($keys as $key) {
				print "Got key: [{$key}] " . count($domainSet[$key]) . "\n";
				sort($domainSet[$key]);
			}

			print_r($ruleSet);
return;

			// FIXME - maybe instead we should compare one character at a time with a pile of
			// single-char comparators until an entire string matches with early false returns
			// whenever there is no character match...

			// 3) Generate an object class that makes it fast/easy
			// to tell if a domain is in the domain tree
			$code = '<?php' . "\n" . <<<END
	class DomainInfo {

		public static function getDomainInfo(\$domain) {

			\$domain = strtolower(\$domain);

END;

			// TODO - deal with UTF-8 (as punycode?) domains
			$first = true;
			$indent = "\t\t";
			$depth = 0;
	/*
			// Decompose the tree
			foreach ($domainTree as $branch => $data) {
				$if = $first ? 'if' : 'else if';
				$first = false;
				
				$code .= "{$indent}{$if} (\$parts[{$depth}] == '{$branch}') {\n";
				$code .= "// functional code goes here\n";
				$code .= "{$indent}}\n";
			}
	 */

			// Decompose the collection

			$prefix = '';
			$prefixSet = array();
			foreach ($domainSet as $tld) {

				// If we're in a set...
				if (count($prefixSet) > 0) {

					// And the first character of this tld matches our prefix...
					if ($tld{0} == $first) {

					// And the second character of this tld matches our prefix...
					if ($tld{1} == $second) {

						// Add this tld to the prefix set
						$prefixSet[] = $tld;
					}
				}
			}
			else {
				//$prefix = substr($
				// FIXME
			}
		}

		$code .= <<<END
		return false;
	}
}

END;

		print $code;


		//print_r($domainTree);

		//$data = explode("\n", $httpResponse->body);
		//print_r($data);
		//print "{$httpResponse->body}\n";
	}
}

