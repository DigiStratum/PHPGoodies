<?php
/**
 * PHPGoodies GStringCollectionExample.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;
use PHPGoodies\GString as String;

// 2) Load up our goodies
require(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));
PHPGoodies::import('Lib.Data.GString');

// 3) Fill up a collection with a bunch of GStrings
$collection = PHPGoodies::instantiate('Lib.Data.Collection', 'GString');
$collection->add(new GString('Hello'));
$collection->add(new GString(', '));
$collection->add(new GString('World'));
$collection->add(new GString("!\n"));

// 4) Iterate over the collection with a callback function that prints each string
$collection->iterate(function ($str) {
	print $str->get();
});

print "Found the World in the collection at index {$collection->findIndex('get', 'World')}\n";
print "The first word's length is: {$collection->find('get', 'Hello')->len()}\n";

