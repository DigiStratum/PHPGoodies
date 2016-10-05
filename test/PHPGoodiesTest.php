<?php
/**
 * PHPGoodies loader class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../PHPGoodies.php'));

class PHPGoodiesTest extends \PHPUnit_Framework_TestCase {

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
	 * Test that PHPGoodies shows as already imported since the test class require_once'd it
	 */
	public function testThatLoaderAlreadyImported() {
		$this->assertTrue(PHPGoodies::isImported('PHPGoodies'));
	}

	/**
	 * Test that an attempt to import something already imported is a no-op
	 */
	public function testThatImportOfAlreadyImportedNoop() {
		$excepted = false;
		try {
			PHPGoodies::import('PHPGoodies');
		}
		catch (\Exception $e) {
			$excepted = false;
		}
		$this->assertFalse($excepted);
	}

	/**
	 * Test that an attempt to import a resource with an empty specifier is rejected
	 *
	 * @expectedException Exception
	 */
	public function testThatEmptyResourceSpecifierIsRejected() {
		PHPGoodies::import('');
	}

	/**
	 * Test that an attempt to import a resource pointing to a missing file is rejected
	 *
	 * @expectedException Exception
	 */
	public function testThatSpecifierForMissingFileIsRejected() {
		PHPGoodies::import('////filename:impossible////');
	}

	/**
	 * Test that an attemp to import a class whose classname does not match the filename is rejected
	 *
	 * @expectedException Exception
	 */
	public function testThatSpecifierForGoodFileNameBadClassNameIsRejected() {
		PHPGoodies::import('test.BadFilename');
	}

	/**
	 * Test that a good class may be imported just fine
	 */
	public function testThatAGoodClassIsImported() {
		PHPGoodies::import('test.GoodClass');
		$this->assertTrue(PHPGoodies::isImported('GoodClass'));
	}

	/**
	 * Test that a good class is properly instantiated
	 */
	public function testThatAGoodClassIsInstantiated() {
		$instance = PHPGoodies::instantiate('test.GoodClass');
		$this->assertTrue(is_object($instance));
		$this->assertTrue($instance instanceof GoodClass);
	}

	/**
	 * Test that attempts to instantiate abstract classes are caught/rejected
	 *
	 * @expectedException Exception
	 */
	public function testThatAbstractClassInstantiationIsRejected() {
		PHPGoodies::instantiate('test.AbstractClass');
	}

	/**
	 * Test that attempts to instantiate a class interface are caught/rejected; it can be
	 * imported, but not instantiated!
	 *
	 * @expectedException Exception
	 */
	public function testThatInterfaceInstantiationIsRejected() {
		PHPGoodies::instantiate('test.GoodInterface');
	}

	/**
	 * Test that we can load a good interface without a problem
	 */
	public function testThatInterfaceImportWorks() {
		PHPGoodies::import('test.GoodInterface');
		$this->assertTrue(PHPGoodies::isImported('GoodInterface'));
	}

	/**
	 * Test that the helper method specifierClassName() gives us what we expect
	 */
	public function testThatSpecifierClassNameWorks() {
		$className = PHPGoodies::specifierClassName('1.2.3.test');
		$this->assertEquals('test', $className);
		$className = PHPGoodies::specifierClassName('');
		$this->assertNull($className);
		$className = PHPGoodies::specifierClassName('   ');
		$this->assertNull($className);
		$className = PHPGoodies::specifierClassName('1.2.');
		$this->assertNull($className);
	}

	/**
	 * Test that requests to instantiate a class with arguments have the args passed correctly
	 */
	public function testThatInstantiatePassesArgs() {
		$value = 'mystery value!';
		$instance = PHPGoodies::instantiate('test.GoodClass', $value);
		$this->assertEquals($value, $instance->arg);
	}
}

