<?php
/**
 * PHPGoodies WebClientExample.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;
use PHPGoodies\WebClient as WebClient;

// 2) Load up our goodies
require(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));
PHPGoodies::import('Util.Web.WebClient');

// 3) Make a new WebClient utility
$wc = PHPGoodies::instantiate('Util.Web.WebClient', WebClient::CLIENT_IE, WebClient::OS_WIN_NT6);
$wc->get('http://www.kelly-rentals.com/');

