<?php
/**
 * PHPGoodies LoginFormExample.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;

// 2) Load up our goodies
require(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

// 3) Use the Csv Goodies to generate an HTML login form
$form = PHPGoodies::instantiate('Lib.Dom.Elements.Form');
$form->setAction('/')->setMethod('POST');
$form->addChild('input')->setName('username')->setType('text');
$form->addChild('input')->setName('password')->setType('password');

print $form->toString() . "\n\n";

