<?php
/**
 * PHPGoodies:Lib_Net_Url - A class for working with emails
 *
 * @uses Lib_Data_Hash
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Email - A class for working with Emails
 */
class Lib_Net_Email {

	/**
	 * Lookup table for valid headers
	 */
	protected $validHeaders;

	/**
	 * The collection of defined headers for THIS email
	 */
	protected $headers;

	/**
	 * Constructor
	 */
	public function __construct() {
		// ref: https://tools.ietf.org/html/rfc4021
		$headers = Array(
			'Date', 'From', 'Sender', 'Reply-To', 'To', 'Cc', 'Bcc', 'Message-ID',
			'In-Reply-To', 'References', 'Subject', 'Comments', 'Keywords', 'Resent-Date',
			'Resent-From', 'Resent-Sender', 'Resent-To', 'Resent-CC', 'Resent-Bcc',
			'Resent-Reply-To', 'Resent-Message-ID', 'Return-Path', 'Received',
			'Encrypted', 'Disposition-Notification-To', 'Disposition-Notification-Options',
			'Accept-Language', 'Original-Message-ID', 'PICS-Label', 'Encoding',
			'List-Archive', 'List-Help', 'List-ID', 'List-Owner', 'List-Post',
			'List-Subscribe', 'List-Unsubscribe', 'Message-Context', 'DL-Expansion-History',
			'Alternate-Recipient', 'Original-Encoded-Information-Types', 'Content-Return',
			'Generate-Delivery-Report', 'Prevent-NonDelivery-Report', 'Obsoletes',
			'Supersedes', 'Content-Identifier', 'Delivery-Date', 'Expiry-Date', 'Expires',
			'Reply-By', 'Importance', 'Incomplete-Copy', 'Priority', 'Sensitivity',
			'Language', 'Conversion', 'Conversion-With-Loss', 'Message-Type', 
			'Autosubmitted', 'Autoforwarded', 'Discarded-X400-IPMS-Extensions',
			'Discarded-X400-MTS-Extensions', 'Disclose-Recipients', 'Deferred-Delivery',
			'Latest-Delivery-Time', 'Originator-Return-Address', 'X400-Content-Identifier',
			'X400-Content-Return', 'X400-Content-Type', 'X400-MTS-Identifier',
			'X400-Originator', 'X400-Received', 'X400-Recipients', 'X400-Trace',
			'MIME-Version', 'Content-ID', 'Content-Description', 'Content-Transfer-Encoding',
			'Content-Type', 'Content-Base', 'Content-Location', 'Content-features',
			'Content-Disposition', 'Content-Language', 'Content-Alternative', 'Content-MD5',
			'Content-Duration'
		);

		// Make a mapping of the lcase header to the properly cased one for easier lookups
		$this->validHeaders = Array();
		foreach ($headers as $header) {
			$this->validHeaders[strtolower($header)] = $header;
		}

		$this->headers = PHPGoodies::instantiate('Lib.Data.Hash');
	}

	/**
	 * Add the named header with the supplied value, if possible
	 *
	 * @todo Scrub the value for acceptable character set
	 *
	 * @param string $name The name of the header we want to add
	 * @param string $value The value to set the named header to
	 *
	 * @return object $this for chaining...
	 */
	public function addHeader($name, $value) {
		$headerName = $this->getProperHeaderName($name);
		if (is_null($headerName)) {
			throw new \Exception("{$name} is not a supported header");
		}

		return $this;
	}

	/**
	 * Get the properly cased header name for that supplied
	 *
	 * @todo Add support for X-** custom headers which will not be in our array
	 *
	 * @param string $headerName Client requested header which may have improper casing
	 *
	 * @return string properly cased equivalent header name, or null if the header is not valid
	 */
	protected function getProperHeaderName($headerName) {
		$key = strtolower($headerName);
		return (isset($this->validHeaders[$key])) ? $this->validHeaders[$key] : null;
	}
}

