<?php
/**
 * PHPGoodies:Lib_Net_Url - A class for working with emails
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Email - A class for working with Emails
 */
class Lib_Net_Email {

	protected $validHeaders;

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
	}

}

