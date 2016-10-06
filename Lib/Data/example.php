<?php
/**
 * PHPGoodies StringCollectionExample.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;
use PHPGoodies\Lib_Data_String as Lib_Data_String;

// 2) Load up our goodies
require(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));
PHPGoodies::import('Lib.Data.String');

// 3) Fill up a collection with a bunch of Strings
$collection = PHPGoodies::instantiate('Lib.Data.Collection', 'String');
$collection->add(new Lib_Data_String('Hello'));
$collection->add(new Lib_Data_String(', '));
$collection->add(new Lib_Data_String('World'));
$collection->add(new Lib_Data_String("!\n"));

// 4) Iterate over the collection with a callback function that prints each string
$collection->iterate(function ($str) {
	print $str->get();
});

print "Found the World in the collection at index {$collection->findIndex('get', 'World')}\n";
print "The first word's length is: {$collection->find('get', 'Hello')->len()}\n";

