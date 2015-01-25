<?php
/**
 * PHPGoodies WebClientExample.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;

// 2) Load up our Goodies...
require(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));
$domain = PHPGoodies::instantiate('Lib.Net.Domain');

