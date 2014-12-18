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
}

$a = new STClassPopulated;

if (isset($a->publicProperty1)) {
	print "publicProperty1 = [{$a->publicProperty1}]\n";
}
if (! isset($a->privateProperty1)) {
	print "privateProperty1 inaccessible from the outside, as expected\n";
}

