<?php
/**
 * PHPGoodies:test_TestCase base class for unit tests
 *
 * We are dynamically abstracting away the actual PHPUnit class in use for our test cases because
 * PHPUnit decided to change their naming convention to use namespacing which breaks all the non-
 * namespaced tests. So if we use our own base class instead of that of PHPUnit for TestCase, then
 * we will be able to dynamically adapt to any PHPUnit version.
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * All the traits that we expect for any version of PHPUnit
 */
trait PHPUnitTraits {
	// TODO: Place any traits here which also need abstraction due to PHPUnit changing rules
}

// PHPUnit >= 6.x (Namespaced)
if (class_exists("\\PHPUnit\\Framework\\TestCase")) {
	class test_TestFramework_TestCase extends \PHPUnit\Framework\TestCase {
		use PHPUnitTraits;
	}
}

// PHPUnit <= 6
else if (class_exists("\\PHPUnit_Framework_TestCase")) {
	class test_TestFramework_TestCase extends \PHPUnit_Framework_TestCase {
		use PHPUnitTraits;
	}
}

// No PHPUnit?
else {
	throw new \Exception("PHPUnit is undefined!");
}

