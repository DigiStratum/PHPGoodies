<?php
/**
 * PHPGoodies:Hash class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

class HashTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Constructor
	 */
	public function __construct() {
		PHPGoodies::import('Lib.Data.Hash');
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
	 * Test that newly instantiated Hash has no data in it
	 */
	public function testThatNewHashIsEmpty() {
		$hash = PHPGoodies::instantiate('Lib.Data.Hash');
		$this->assertEquals(0, $hash->num());
	}

	/**
	 * Test that a new hash with a single item added to it shows up in the count
	 */
	public function testThatNewHashSingleItemCounted() {
		$hash = PHPGoodies::instantiate('Lib.Data.Hash');
		$hash->set('name', 'value');
		$this->assertEquals(1, $hash->num());
	}

	/**
	 * Test that a hash with a single item goes empty when the item is deleted
	 */
	public function testThatSingleItemHashGoesEmptyWhenDeleted() {
		$hash = PHPGoodies::instantiate('Lib.Data.Hash');

		// Set/chain
		$hasIt = $hash->set('name', 'value')->has('name');
		$this->assertTrue($hasIt);
		$this->assertEquals(1, $hash->num());

		// Del/chain
		$hasIt = $hash->del('name', 'value')->has('name');
		$this->assertFalse($hasIt);
		$this->assertEquals(0, $hash->num());
	}

	/**
	 * Test that a set item may be identically retrieved
	 */
	public function testThatASetItemGetsIdenticalValue() {
		$hash = PHPGoodies::instantiate('Lib.Data.Hash');
		$value = $hash->set('name', 'value')->get('name');
		$this->assertEquals('value', $value);
	}

	/**
	 * Test that hash empties out correctly
	 */
	public function testThatHashEmptiesOut() {
		$hash = PHPGoodies::instantiate('Lib.Data.Hash');

		// Set several/check
		$num = $hash->set('n1', 'v1')->set('n2', 'v2')->set('n3', 'v3')->num();
		$this->assertEquals(3, $num);

		// Empty/check
		$num = $hash->nil()->num();
		$this->assertEquals(0, $num);
	}

	/**
	 * Test that raw hash returns expected array contents
	 */
	public function testThatHashReturnsExpectedArrayContents() {
		$hash = PHPGoodies::instantiate('Lib.Data.Hash');

		for ($xx = 0; $xx < 10; $xx++) $hash->set("n{$xx}", "v{$xx}");
		$num = $hash->num();
		$this->assertEquals(10, $num);

		$all = $hash->all();

		for ($xx = 0; $xx < 10; $xx++) {
			$this->assertTrue(isset($all["n{$xx}"]));
			$this->assertEquals("v{$xx}", $all["n{$xx}"]);
		}
	}

	/**
	 * Test that putting an array into the hash results in exactly that number of elements and all items retrievable with expected value
	 */
	public function testThatPuttingArrayContentsIsHandledProperly() {
		$hash = PHPGoodies::instantiate('Lib.Data.Hash');
		$all = array();
		for ($xx = 0; $xx < 10; $xx++) $all["n{$xx}"] = "v{$xx}";

		$hash->put($all);
		$num = $hash->num();
		$this->assertEquals(10, $num);

		foreach ($all as $name => $expected) {
			$hasIt = $hash->has($name);
			$this->assertTrue($hasIt);
			$actual = $hash->get($name);
			$this->assertEquals($expected, $actual);
		}
	}
}

