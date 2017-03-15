<?php
/**
 * PHPGoodies Lib.Net.Email example
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;
use PHPGoodies\Lib_Net_Email as Lib_Net_Email;

// 2) Load up our goodies
require(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));
PHPGoodies::import('Lib.Net.Email');

// 3) Send an email!
$email = PHPGoodies::instantiate('Lib.Net.Email');
$res = $email
	->setHeader('To', 'info@digistratum.com')
	->setHeader('From', 'info@digistratum.com')
	->setHeader('Subject', 'Test Subject')
	->setTextBody('This is a test email message body with plain text')
	->setHtmlBody('This is a test email message body with <b>HTML</b>')
	->send();
print "Result: " . ($res ? 'PASS!' : 'FAIL!') . "\n\n";

