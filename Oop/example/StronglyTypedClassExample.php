<?php
/**
 * PHPGoodies DtoExample.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
// A little different than most examples since we're using namespaced
// constants below which are annoying to import a bunch of
use PHPGoodies\STClass as STClass;

// 2) Load up our goodies
require(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));
PHPGoodies\PHPGoodies::import('Oop.STClass');

/**
 * Extend and populate STClass as it would be in a normal application
 */
class STClassPopulated extends STClass {

	/**
	 * Constructor
	 */
	public function __construct() {
		
		$this->___constructor();

		// Add a private property
		$this->addClassMember(
			'privateProperty1',
			PHPGoodies\ST_TYPE_STRING,
			PHPGoodies\ST_SCOPE_PRIVATE,
			'Hot Tamales'
		);

		// Add a public property
		$this->addClassMember(
			'publicProperty1',
			PHPGoodies\ST_TYPE_STRING,
			PHPGoodies\ST_SCOPE_PUBLIC,
			'Lemon Drops'
		);
	}

	/**
	 * @proto public boolean myProtoMethod(boolean)
	 */
	public function ___proto___myProtoMethod___1() {
		return function ($value) {
			return $value;
		};
	}

	/**
	 * @proto public integer myProtoMethod(string)
	 */
	public function ___proto___myProtoMethod___2() {
		return function ($value) {
			return strlen($value);
		};
	}
}

$a = new STClassPopulated;

if (isset($a->publicProperty1)) {
	print "publicProperty1 = [{$a->publicProperty1}]\n";
}
if (! isset($a->privateProperty1)) {
	print "privateProperty1 inaccessible from the outside, as expected\n";
}

if ($a->myProtoMethod(true)) {
	print "Got a successful TRUE back from myProtoMethod\n";
}
if (! $a->myProtoMethod(false)) {
	print "Got a successful FALSE back from myProtoMethod\n";
}
try {
	$res = $a->myProtoMethod(1);
}
catch (\Exception $e) {
	print "Got an expected exception attempting to call myProtoMethod(integer) which is undefined\n";
}
if (13 == $a->myProtoMethod('Hello, World!')) {
	print "Successfully applied ad hoc polymorphism to get myProtoMethod(string)\n";
}

