<?php
/**
 * PHPGoodies HttpRequestExample.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;

// 2) Load up our goodies
require(realpath(dirname(__FILE__) . '/../../../../PHPGoodies.php'));
$reqInfo = PHPGoodies::instantiate('Lib.Net.Http.Request');

// 3) Take a look at the current request
print_r($reqInfo->getInfo());

