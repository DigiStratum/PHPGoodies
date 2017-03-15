<?php
/**
 * PHPGoodies:Lib_Net_Url - A class for working with emails
 *
 * @todo Add support for checking email addresses against RFC 2822 for compliance (http://www.faqs.org/rfcs/rfc2822)
 * @todo Add support for checking subject against RFC 2047 for compliance (http://www.faqs.org/rfcs/rfc2047)
 * Ref: RFC 1896, RFC 2045, RFC 2046, RFC 2047, RFC 2048, RFC 2049, RFC 2822, RFC 821
 * ref: RFC 1341 (https://www.w3.org/Protocols/rfc1341/7_2_Multipart.html)
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
	 * The collection of body parts for this email; note there can be multiples for multi-part
	 */
	protected $bodyParts;

	/**
	 * Constructor
	 *
	 * @param string $email Optional precomposed email text to decompose and initialize with
	 */
	public function __construct($email = null) {
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
		$this->bodyParts = PHPGoodies::instantiate('Lib.Data.Hash');

		if (! is_null($email)) $this->decompose($email);
	}

	/**
	 * Set the named header to the supplied value, if possible
	 *
	 * @todo Scrub the value for acceptable character set
	 *
	 * @param string $name The name of the header we want to add
	 * @param string $value The value to set the named header to
	 *
	 * @return object $this for chaining...
	 */
	public function setHeader($name, $value) {
		$headerName = $this->getProperHeaderName($name);
		if (is_null($headerName)) {
			throw new \Exception("{$name} is not a supported header");
		}

		$this->headers->set($name, $value);

		return $this;
	}

	/**
	 * Set the email body
	 *
	 * Note that our default is text/plain mainly because for simple applications, the easiest
	 * thing for them to do is pass along a plain text body whose formatting will be preserved.
	 * A more advanced application capable of forming an HTML or even multi-part body will have
	 * to override the type or use one of the other convenience setters.
	 *
	 * @param string $body The body content for the email
	 * @param string $type The content type which best describes the body (optional, defaults to text/plain)
	 * @param string $charset The character set which best describes the body (optional, defaults to us-ascii)
	 *
	 * @return object $this for chaining...
	 */
	public function setBody($body, $type='text/plain', $charset='us-ascii') {
		$supportedBodyTypes = Array('text/plain', 'text/html');
		if (! in_array($type, $supportedBodyTypes)) {
			throw new \Exception("Unsupported body type: {$type}");
		}
		$key = "{$type}; charset={$charset}";
		$this->bodyParts->set($key, $body);
		return $this;
	}

	/**
	 * Set the email body for plain text explicitly
	 *
	 * @param string $body The body content for the email
	 * @param string $charset The character set which best describes the body (optional, defaults to us-ascii)
	 *
	 * @return object $this for chaining...
	 */
	public function setTextBody($text, $charset='us-ascii') {
		$this->setBody($text, 'text/plain', $charset);
		return $this;
	}

	/**
	 * Set the email body for html explicitly
	 *
	 * @param string $body The body content for the email
	 * @param string $charset The character set which best describes the body (optional, defaults to us-ascii)
	 *
	 * @return object $this for chaining...
	 */
	public function setHtmlBody($html, $charset='us-ascii') {
		$this->setBody($html, 'text/html', $charset);
		return $this;
	}


	/**
	 * Decompose (parse) the full text of an email into our properties
	 */
	protected function decompose($email) {
		$this->headers->nil();
		$this->bodyParts->nil();
		throw new \Exception('parse() is not yet implemented!');
	}

	/**
	 * Compose our properties into a full email text
	 */
	public function compose() {
		throw new \Exception('compose() is not yet implemented!');
	}

	/**
	 * Compose just the boy portion of the email message
	 *
	 * Handles the intricacies of forming the multi-part boundaries, etc.
	 *
	 * @return object Generic object with body and type (Content-Type) properties populated
	 */
	protected function composeBody() {
		if ($this->bodyParts->num() == 0) {
			throw new \Exception('Missing required email body');
		}

		$multipart = ($this->bodyParts->num() > 1);
		if ($multipart) {
			$body = "The following message uses multi-part encoding. There are multiple views of the same message which are not supported by your mail client if you are seeing this explanation.\n\n";
			PHPGoodies::import('Lib.Random.String');
			$boundary = Lib_Random_String::get(50);
		}
		else {
			$body = $boundary = '';
		}
		$contentType = '';
		$this->bodyParts->iterate(function ($type, $content) use (&$body, $boundary, $multipart, &$contentType) {

			// For multipart message
			if ($multipart) {
				// Put our boundary marker/ContentType in front of each part
				$body .= "\r\n--{$boundary}\r\n";
				$body .= "Content-Type: {$type}\r\n";
			}
			else {
				// Single-part message just capture the ContentType
				$contentType = $type;
			}

			// Append this body part
			$body .= $content;

			// For non-multipart we can wrap up
			if (! $multipart) return false;
		});

		// Last part of a multipart must trail with the closing boundary
		if ($multipart) {
			$body .= "\r\n--{$boundary}--\r\n";
			$contentType = "multipart/alternative; boundary={$boundary}";
		}

		$res = new \StdClass();
		$res->body = $body;
		$res->type= $contentType;

		return $res;
	}

	/**
	 * Send a full email text
	 *
	 * @param string $mtaHost Optionally supply the host:port to connect to for direct SMTP mail
	 */
	public function composeAndSend($mtaHost = null) {
		throw new \Exception('composeAndSend() is not yet implemented!');
		$email = $this->compose();
		$this->sendPrecomposed($email, $mtaHost);
	}

	/**
	 * Send the email
	 *
	 * Access the MTA directly to send the message via SMTP if $email param is supplied, else
	 * use PHP native mail() to send the message.
	 *
	 * @param string $email Optionally provide a pre-composed email body to send straight to MTA
	 * @param string $mtaHost Optionally supply the host:port to connect to for direct SMTP mail
	 */
	public function send($email = null, $mtaHost = null) {
		if (! is_null($email)) {
			$this->sendPrecomposed($email, $mtaHost);
			return;
		}

		// Check that we have the minimum set of required data/headers
		$required = Array(
			'To' => true,
			'From' => false,
			'Subject' => true
		);
		$data = Array();
		foreach ($required as $headerName => $extract) {
			if (! $this->headers->has($headerName)) {
				throw new \Exception('Missing required header field value for: ' . $headerName);
			}
			// Extract the ones that the mail() function requires as arguments...
			if ($extract) {
				$data[$headerName] = $this->headers->get($headerName);
				$this->headers->del($headerName);
			}
		}

		// Form the email body
		$res = $this->composeBody();
		$this->setHeader('Content-Type', $res->type);

		// Form the rest of the headers
		$headers = '';
		$this->headers->iterate(function ($name, $value) use (&$headers) {
			$headers .= "{$name}: {$value}\r\n";
		});
		$headers .= "\r\n";

		return mail($data['To'], $data['Subject'], $res->body, $headers);
	}

	/**
	 * Send the email precomposed
	 *
	 * Access the MTA directly to send the message via SMTP.
	 *
	 * @param string $email Provide a pre-composed email body to send straight to MTA
	 * @param string $mtaHost Optionally supply the host:port to connect to for direct SMTP mail
	 */
	protected function sendPrecomposed($email, $mtaHost = null) {
		throw new \Exception('send("pre-composed message") is not yet implemented!');
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

