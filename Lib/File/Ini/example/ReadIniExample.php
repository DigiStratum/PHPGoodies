<?php
/**
 * PHPGoodies ReadIniExample.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;

// 2) Load up our goodies
require(realpath(dirname(__FILE__) . '/../../../../PHPGoodies.php'));
$ini = PHPGoodies::instantiate('Lib.File.Ini.Ini', dirname(__FILE__) . '/example.ini');
$ini->load();
foreach ($ini->getSections() as $section) {
	print "Section: {$section}\n";
	print_r($ini->getSettings($section));
}

