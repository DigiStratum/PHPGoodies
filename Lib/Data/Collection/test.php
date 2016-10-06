<?php
/**
 * PHPGoodies:Lib_Data_Collection class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

class Lib_Data_Collection_Test extends \PHPUnit_Framework_TestCase {

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
	 * Test that newly instantiated Collection has no data in it
	 */
	public function testThatNewCollectionIsEmpty() {
		$collection = PHPGoodies::instantiate('Lib.Data.Collection', 'TestClassA');
		$this->assertEquals(0, $collection->num());
		$this->assertEquals(PHPGoodies::namespaced('TestClassA'), $collection->getClassName());
	}

	/**
	 * Test that a collection accepts the addition of an object of the right type
	 */
	public function testThatCollectionAcceptsMatchingObject() {
		$collection = PHPGoodies::instantiate('Lib.Data.Collection', 'TestClassA');
		$index = $collection->add(new TestClassA());
		$this->assertEquals(0, $index);
		$this->assertEquals(1, $collection->num());
	}

	/**
	 * Test that a collection rejects the addition of objects of the wrong type
	 *
	 * @expectedException Exception
	 */
	public function testThatCollectionRejectsDifferentObjects() {
		$collection = PHPGoodies::instantiate('Lib.Data.Collection', 'TestClassA');
		$collection->add(new TestClassB());
	}

	/**
	 * Test that getting items from the collection just returns references to them
	 */
	public function testThatCollectionGetProvidesReferences() {
		$collection = PHPGoodies::instantiate('Lib.Data.Collection', 'TestClassA');
		$index = $collection->add(new TestClassA());

		// Get two references to the same collection item
		$refA =& $collection->get($index);
		$refB =& $collection->get($index);
		$refA->value = 'bananas';

		// Now they should have the same value because they should be the same instance
		$this->assertEquals($refA->value, $refB->value);
	}

	/**
	 * Test that getting a collection item with a bad index just gives null and doesn't freak out
	 */
	public function testThatCollectionGetBadIndexGivesNull() {
		$collection = PHPGoodies::instantiate('Lib.Data.Collection', 'TestClassA');
		$ref =& $collection->get(100);
		$this->assertNull($ref);
	}

	/**
	 * Test that items in the collection may be deleted by index and the index is preserved
	 */
	public function testThatCollectionItemsGetDeleted() {
		$collection = PHPGoodies::instantiate('Lib.Data.Collection', 'TestClassA');

		$index1 = $collection->add(new TestClassA());
		$index2 = $collection->add(new TestClassA());
		$index3 = $collection->add(new TestClassA());
		$this->assertEquals(3, $collection->num());

		$this->assertTrue($collection->del($index2));
		$this->assertEquals(2, $collection->num());
		$this->assertFalse($collection->del($index2));

		$this->assertTrue($collection->del($index1));
		$this->assertEquals(1, $collection->num());
		$this->assertFalse($collection->del($index2));
		$this->assertFalse($collection->del($index1));

		$this->assertTrue($collection->del($index3));
		$this->assertEquals(0, $collection->num());
		$this->assertFalse($collection->del($index2));
		$this->assertFalse($collection->del($index1));
		$this->assertFalse($collection->del($index3));
	}

	/**
	 * Test that the has() method sees what we expect and doesn't what we don't
	 */
	public function testThatCollectionHasWorksAsExpected() {
		$collection = PHPGoodies::instantiate('Lib.Data.Collection', 'TestClassA');
		$index = $collection->add(new TestClassA());
		$this->assertTrue($collection->has($index));
		$this->assertFalse($collection->has($index + 1));
	}

	/**
	 * Test that the pluck method does work with attributes OR methods
	 *
	 * Also covers the success cases of iterate() method!
	 */
	public function testThatPluckPlucks() {
		$collection = PHPGoodies::instantiate('Lib.Data.Collection', 'TestClassA');

		$provided = array(11,22,33,44,55);
		foreach ($provided as $value) {
			$collection->add(new TestClassA($value));
		};

		// Attributes...
		$plucked = $collection->pluck('value');
		$this->assertTrue(is_array($plucked));
		$this->assertEquals(count($provided), count($plucked));
		foreach ($plucked as $index => $value) {
			$this->assertEquals($provided[$index], $plucked[$index]);
		}

		// Methods...
		$plucked = $collection->pluck('getValue');
		$this->assertTrue(is_array($plucked));
		$this->assertEquals(count($provided), count($plucked));
		foreach ($plucked as $index => $value) {
			$this->assertEquals($provided[$index], $plucked[$index]);
		}
	}

	/**
	 * Test that the pluck method rejects pluck operations for invalid properties/methods
	 *
	 * @expectedException Exception
	 */
	public function testThatPluckRejectsInvalidProperties() {
		$collection = PHPGoodies::instantiate('Lib.Data.Collection', 'TestClassA');
		$collection->add(new TestClassA(1));
		$collection->pluck('invalid-property-name');
	}

	/**
	 * Test that the iterate method doesn't attempt to run if it isn't provided with a callable
	 *
	 * @expectedException Exception
	 */
	public function testThatIterateRejectsNonCallables() {
		$collection = PHPGoodies::instantiate('Lib.Data.Collection', 'TestClassA');
		$collection->iterate('a worthless string');
	}

	/**
	 * Test that the find method actually finds what we want in the collection
	 *
	 * Also covers the findIndex method's success cases!
	 */
	public function testThatFindFinds() {
		$collection = PHPGoodies::instantiate('Lib.Data.Collection', 'TestClassA');
		$index1 = $collection->add(new TestClassA(11));
		$index2 = $collection->add(new TestClassA(22));
		$index3 = $collection->add(new TestClassA(33));
		$found1 = $collection->find('value', 11);
		$this->assertEquals(11, $found1->value);
		$found2 = $collection->find('value', 22);
		$this->assertEquals(22, $found2->value);
		$found3 = $collection->find('value', 33);
		$this->assertEquals(33, $found3->value);
	}

	/**
	 * Test that the findIndex method rejests requests for missing methods/properties
	 *
	 * @expectedException Exception
	 */
	public function testThatFindIndexRejectsInvalidProperties() {
		$collection = PHPGoodies::instantiate('Lib.Data.Collection', 'TestClassA');
		$collection->findIndex('invalid-property-name', 777); // Value is irrelevant since name does not exist
	}

	/**
	 * Test that hasWith(), a simple wrapper that either sees what has been requested or doesn't
	 */
	public function testThatHasWithReportsAsExpected() {
		$collection = PHPGoodies::instantiate('Lib.Data.Collection', 'TestClassA');
		$index1 = $collection->add(new TestClassA(11));
		$this->assertTrue($collection->hasWith('value', 11));
		$this->assertFalse($collection->hasWith('value', 99));
	}
}

class TestClassA {
	public $value;
	public function __construct($value = null) {
		$this->value = $value;
	}
	public function getValue() {
		return $this->value;
	}
}

class TestClassB {
}

