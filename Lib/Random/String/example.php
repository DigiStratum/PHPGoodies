<?php
/**
 * PHPGoodies StringCollectionExample.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;
use PHPGoodies\Lib_Random_String as Lib_Random_String;

// 2) Load up our goodies
require(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));
PHPGoodies::import('Lib.Random.String');

$rsall = Lib_Random_String::get(10);
$rsAZ = Lib_Random_String::get(20, 'A-Z');
$rsaz = Lib_Random_String::get(30, 'a-z');
$rs09 = Lib_Random_String::get(40, '0-9');

// 3) Generate some random strings!
print "All = [{$rsall}]\n";
print "A-Z = [{$rsAZ}]\n";
print "a-z = [{$rsaz}]\n";
print "0-9 = [{$rs09}]\n";

