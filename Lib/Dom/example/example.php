<?php
/**
 * PHPGoodies example1.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;
use PHPGoodies\InputElement as InputElement;

// 2) Load up our goodies
require(realpath('../../../PHPGoodies.php'));
PHPGoodies::import('Lib.Dom.Elements.InputElement');

// 3) Use the Csv Goodie to print the tokenized data extracted from a CSV string
$el = new InputElement();
$el->setName('test')->setId('MagicId');

print $el->toString();

