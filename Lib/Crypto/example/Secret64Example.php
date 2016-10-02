<?php
/**
 * PHPGoodies Secret64Example.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;

// 2) Load up our goodies
require(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

// 3) Do some super secret encoding
list($usec, $sec) = explode(' ', microtime());
$SECRET = (float) $sec + ((float) $usec * 100000);
$secret64 = PHPGoodies::instantiate('Lib.Crypto.Secret64', $SECRET);

$message = 'BE SURE TO DRINK YOUR OVALTINE';
$base64 = base64_encode($message);
$encoded = $secret64->encode($message);
$decoded = $secret64->decode($encoded);

// Note that you can take the $base64 string and pop it right into
// a site like base64decode.org and get the original message...
print "Base64: {$base64}\n\n";
print "Encoded: {$encoded}\n";
print "Decoded: {$decoded}\n\n";

// 4) Let's see what happens if we try to decode with the wrong SECRET!
$bad64 = PHPGoodies::instantiate('Lib.Crypto.Secret64', $SECRET+1);
$bad = $bad64->decode($encoded);
print "Bad: {$bad}\n";

