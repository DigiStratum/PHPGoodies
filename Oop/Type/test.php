<?php
/**
 * PHPGoodies:Type class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Oop.Exception.TypeMismatch');

class SimpleTestClass {}

class TypeTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Constructor
	 */
	public function __construct() {
		PHPGoodies::import('Oop.Type');
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
	 * Test that getType strtolowers its results
	 */
	public function testThatNullsAreLowercase() {
		$data = NULL;
		$type = Oop_Type::getType($data);
		$this->assertEquals($type, 'null');
	}

	/**
	 * Test that 'Closure's are returned as 'function's
	 */
	public function testThatClosuresAreFunctions() {
		$data = function () { print('Hello, World!'); };
		$type = Oop_Type::getType($data);
		$this->assertEquals($type, 'function');
	}

	/**
	 * Test that 'stdClass'es are returned as 'object's
	 */
	public function testThatStdClassesAreObjects() {
		$data = new \StdClass();
		$type = Oop_Type::getType($data);
		$this->assertEquals($type, 'object');
	}

	/**
	 * Test that any other object class is returned as 'class:classname'
	 */
	public function testThatOtherClassesAreClasses() {
		$data = new SimpleTestClass();
		$type = Oop_Type::getType($data);
		$this->assertEquals($type, 'class:SimpleTestClass');
	}

	/**
	 * Test that namespace is properly ignored
	 */
	public function testThatNamespaceIsProperlyIgnored() {
		$data = new SimpleTestClass();
		$type = Oop_Type::getType($data, false);
		$this->assertEquals($type, 'class:PHPGoodies\\SimpleTestClass');
		$type = Oop_Type::getType($data);
		$this->assertEquals($type, 'class:SimpleTestClass');
	}

	/**
	 * Test that all other data types are preserved
	 */
	public function testThatTypesArePreserved() {
		$data = 3;
		$type = Oop_Type::getType($data);
		$this->assertEquals($type, 'integer');
		$data = 3.14159;
		$type = Oop_Type::getType($data);
		$this->assertEquals($type, 'double');
		$data = 'Hello, World';
		$type = Oop_Type::getType($data);
		$this->assertEquals($type, 'string');
		$data = true;
		$type = Oop_Type::getType($data);
		$this->assertEquals($type, 'boolean');
		$data = Array();
		$type = Oop_Type::getType($data);
		$this->assertEquals($type, 'array');
		$data = fopen(__FILE__, 'r');
		$type = Oop_Type::getType($data);
		fclose($data);
		$this->assertEquals($type, 'resource');
	}

	/**
	 * Test that isType matches what we expect it to
	 */
	public function testThatIsTypeMatchesExpected() {
		$data = NULL;
		$this->assertTrue(Oop_Type::isType($data, 'null'));
		$data = 3;
		$this->assertTrue(Oop_Type::isType($data, 'integer'));
		$data = 3.14159;
		$this->assertTrue(Oop_Type::isType($data, 'double'));
		$data = 'Hello, World!';
		$this->assertTrue(Oop_Type::isType($data, 'string'));
		$data = true;
		$this->assertTrue(Oop_Type::isType($data, 'boolean'));
		$data = Array();
		$this->assertTrue(Oop_Type::isType($data, 'array'));
		$data = new \StdClass();
		$this->assertTrue(Oop_Type::isType($data, 'object'));
		$data = new SimpleTestClass();
		$this->assertTrue(Oop_Type::isType($data, 'class:SimpleTestClass'));
		$data = fopen(__FILE__, 'r');
		$res = Oop_Type::isType($data, 'resource');
		fclose($data);
		$this->assertTrue($res);
	}

	/**
	 * Test that isType rejects the unexpected
	 */
	public function testThatIsTypeRejectsTheUnexpected() {
		$data = NULL;
		$this->assertFalse(Oop_Type::isType($data, 'french fries!'));
	}

	/**
	 * Test that isType carries through the namespace ignore flag
	 */
	public function testThatIsTypeCarriesThroughNamespaceIgnorance() {
		$data = new SimpleTestClass();
		$this->assertTrue(Oop_Type::isType($data, 'class:PHPGoodies\\SimpleTestClass', false));
	}

	/**
	 * Test that requireType throws an exception on mismatch
	 *
	 * @expectedException PHPGoodies\Oop_Exception_TypeMismatch
	 */
	public function testThatRequireTypeExceptsOnMismatch() {
		$data = new SimpleTestClass();
		Oop_Type::requireType($data, 'french fries!');
	}

	/**
	 * Test that requireType does NOT throw an exception on match
	 */
	public function testThatRequireTypeAcceptsOnMatch() {
		$data = 3;
		Oop_Type::requireType($data, 'integer');
	}

	/**
	 * Test that optionalType allows nulls
	 */
	public function testThatOptionalTypeAllowsNulls() {
		$data = null;
		Oop_Type::optionalType($data, 'string');
	}

	/**
	 * Test that optionalType allows non-null values if they match type
	 */
	public function testThatOptionalTypeAllowsNonNullTypeMatch() {
		$data = 3;
		Oop_Type::optionalType($data, 'integer');
	}

	/**
	 * Test that optionalType throws an exception on non-null mismatch
	 *
	 * @expectedException PHPGoodies\Oop_Exception_TypeMismatch
	 */
	public function testThatOptionalTypeRequiresNonNullMatch() {
		$data = new SimpleTestClass();
		Oop_Type::optionalType($data, 'french fries!');
	}
}
