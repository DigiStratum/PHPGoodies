<?php
/**
 * PHPGoodies:TClass class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Oop.TClass');

class TClassTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Constructor
	 */
	public function __construct() {
	}

	/**
	 * Setup to occur ahead of each test method invocation
	 */
	public function setup() {
	}

	/**
	 * Teardown to occur after each test method invocation
	 */
	public function teardown() {
	}

	/**
	 * Just verify that we can instantiate such a class
	 */
	public function testThatTClassIsInstantiable() {
		$tClass = PHPGoodies::instantiate('Lib.Oop.TClass');
		$this->assertTrue(is_object($tClass));
		$this->assertTrue($tClass instanceof TClass);
	}

	/**
	 * Test that we can externally add public properties to the TClass
	 */
	public function testThatPublicPropertiesGetAdded() {
		$tClass = PHPGoodies::instantiate('Lib.Oop.TClass');
		$tClass->add('publicProperty1', 1337);	// Add a number
		$value = $tClass->publicProperty1;
		$this->assertEquals(1337, $value);
	}

	/**
	 * Test that attempts to set a different value type after the property is added are rejected
	 *
	 * @expectedException InvalidArgumentException
	 */
	public function testThatMismatchedDataAssignmentsAreRejected() {
		$tClass = PHPGoodies::instantiate('Lib.Oop.TClass');
		$tClass->add('publicProperty1', 1337);		// Add a number
		$tClass->publicProperty1 = 'Jelly Beans';	// Try to set it to a string!
	}

	/**
	 * Test that an extended TClass gets the expected classMembers set up
	 */
	public function testThatTClassExtendedHasExpectedClassMembers() {
		$tClassExt = new TClassExtended();
		$classMembers = $tClassExt->spy();

		// It should be an array
		$this->assertTrue(is_array($classMembers));

		// With N elements
		$this->assertEquals(1, count($classMembers));

		// It should have a privateProperty1 object
		$this->assertTrue(isset($classMembers['privateProperty1']));
		$tmp =& $classMembers['privateProperty1'];
		$this->assertTrue(is_object($tmp));
		$this->assertEquals('string', $tmp->type);
		$this->assertEquals(TClass::SCOPE_PRIVATE, $tmp->scope);
		$this->assertEquals('Hot Tamales', $tmp->value);
		$this->assertNull($tmp->returnType);
	}

	/**
	 * Test that outside requests for private properties are rejected
	 *
	 * @expectedException PHPGoodies\AccessDeniedException
	 */
	public function testThatOutsideRequestsForPrivatePropertiesAreRejected() {
		$tClassExt = new TClassExtended();
		$value = $tClassExt->privateProperty1;
		print "value=[{$value}]\n";
	}
}

// Note: update checks in f.testThatTClassExtendedHasExpectedClassMembers() when additions are made:
class TClassExtended extends TClass {

	/**
	 * Constructor
	 */
	public function __construct() {

		// Add a private property
		$this->addClassMember('privateProperty1', 'string', TClass::SCOPE_PRIVATE, 'Hot Tamales');
	}

	/**
	 * A spy method for testing that allows us to inspect the non-public data structures
	 */
	public function spy() {
		return $this->classMembers;
	}
}

